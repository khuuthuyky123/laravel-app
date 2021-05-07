<template>
    <div class="my-component container mt-5">
        <h2>Profile</h2>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users.data" :key="user.id">
                    <th scope="row">{{ 10*(users.current_page-1)+index+1 }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                </tr>
            </tbody>
        </table>
        <div>{{ users.from }} - {{ users.to }} of {{ users.total }}</div>
        <ul class="pagination">
            <li
                class="page-item"
                :class="{ disabled: users.prev_page_url === null }"
                @click="users.prev_page_url && getusers(users.current_page - 1)"
            >
                <a class="page-link" href="#">Previous</a>
            </li>
            <li
                class="page-item"
                v-if="users.prev_page_url"
                @click="getusers(users.current_page - 1)"
            >
                <a class="page-link" href="#">{{ users.current_page - 1 }}</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">{{ users.current_page }}</a>
            </li>
            <li
                class="page-item"
                v-if="users.next_page_url"
                @click="getusers(users.current_page + 1)"
            >
                <a class="page-link" href="#">{{ users.current_page + 1 }}</a>
            </li>
            <li
                class="page-item"
                :class="{ disabled: users.next_page_url === null }"
                @click="users.next_page_url && getusers(users.current_page + 1)"
            >
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: {},
            error: null
        };
    },
    created() {
        this.getusers();
    },
    methods: {
        async getusers(page = 1) {
            try {
                const response = await axios.get("/users?page=" + page);
                this.users = response.data.users;
                console.log(response);
            } catch (error) {
                this.error = error.response.data;
            }
        }
    }
};
</script>

<style lang="scss" scoped></style>

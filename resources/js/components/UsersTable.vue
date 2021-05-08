<template>
    <div class="container mt-5">
        <h2>Users Table</h2>
        <div class="search-component" >
            <b-input
                v-model="searchKey"
                id="type-search"
                type="search"
                style="display: inline-block; width:50%"
                v-on:update="search()"
                debounce="300"
            >
            </b-input>
            <button v-b-modal.modalFilter  class="btn"
                ><filter-icon size="2x" class="filter-icon"></filter-icon>
            </button>

            <b-modal id="modalFilter" hide-backdrop content-class="shadow" title="Filter" hide-footer>
                <div v-if="show">
                    <b-form-group label="Roles:">
                        <b-form-checkbox-group
                            id="checkbox-group-1"
                            v-model="filterKey"
                           v-on:change="search()"
                        >
                            <b-form-checkbox value="learner">Learner</b-form-checkbox>
                            <b-form-checkbox value="author">Author</b-form-checkbox>
                            <b-form-checkbox value="superuser">Superuser</b-form-checkbox>
                            <b-form-checkbox value="administrator">Administrator</b-form-checkbox>
                        </b-form-checkbox-group>
                    </b-form-group>
                    <div style="text-align:center;">
                    
                    
                    </div>
                </div>
            </b-modal>
        </div>
        <table class="table table-hover table-sm ">
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
                <tr v-for="(user, index) in users.data" :key="user.id">
                    <th scope="row">
                        {{ 10 * (users.current_page - 1) + index + 1 }}
                    </th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td>
                        <button class="btn" @click="editProfile(index)">
                            <edit-icon size="1x" class="edit-icon"></edit-icon>
                        </button>
                        <!-- <button class="btn btn-danger" @click=" = false">Cancel</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
        <div>{{ users.from }} - {{ users.to }} of {{ users.total }}</div>
        <ul class="pagination" v-if="this.searchKey == '' && this.filterKey==[]">
            <li
                class="page-item"
                :class="{ disabled: users.prev_page_url === null }"
                @click="users.prev_page_url && getUsers(users.current_page - 1)"
            >
                <a class="page-link" href="#">Previous</a>
            </li>
            <li
                class="page-item"
                v-if="users.prev_page_url"
                @click="getUsers(users.current_page - 1)"
            >
                <a class="page-link" href="#">{{ users.current_page - 1 }}</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">{{ users.current_page }}</a>
            </li>
            <li
                class="page-item"
                v-if="users.next_page_url"
                @click="getUsers(users.current_page + 1)"
            >
                <a class="page-link" href="#">{{ users.current_page + 1 }}</a>
            </li>
            <li
                class="page-item"
                :class="{ disabled: users.next_page_url === null }"
                @click="users.next_page_url && getUsers(users.current_page + 1)"
            >
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
        <ul class="pagination" v-else>
            <li
                class="page-item"
                :class="{ disabled: users.prev_page_url === null }"
                @click="users.prev_page_url && search(users.current_page - 1)"
            >
                <a class="page-link" href="#">Previous</a>
            </li>
            <li
                class="page-item"
                v-if="users.prev_page_url"
                @click="search(users.current_page - 1)"
            >
                <a class="page-link" href="#">{{ users.current_page - 1 }}</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">{{ users.current_page }}</a>
            </li>
            <li
                class="page-item"
                v-if="users.next_page_url"
                @click="search(users.current_page + 1)"
            >
                <a class="page-link" href="#">{{ users.current_page + 1 }}</a>
            </li>
            <li
                class="page-item"
                :class="{ disabled: users.next_page_url === null }"
                @click="users.next_page_url && search(users.current_page + 1)"
            >
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </div>
</template>

<script>
import { EditIcon } from "vue-feather-icons";
import { FilterIcon } from "vue-feather-icons";

export default {
    components: {
        EditIcon,
        FilterIcon
    },
    data() {
        return {
            users: {},
            searchKey: "",
            filterKey: [],
            error: null,

            show:true,
        };
    },
    created() {
        this.getUsers();
    },
    methods: {
        async getUsers(page = 1) {
            try {
                const response = await axios.get(
                    "/users?page=" + page
                );
                this.users = response.data.users;
                console.log(response);
            } catch (error) {
                this.error = error.response.data;
            }
        },
        async editProfile(id) {
            try {
            } catch (error) {}
        },
        async search(page = 1) {
            try {
                const response = await axios.get(
                    "/users?searchKey=" + this.searchKey + "&filterKey="+this.filterKey+"&page=" + page
                );
                console.log(response);
                this.users = response.data.users;
            } catch (error) {
                this.error = error.response.data;
            }
        },
        
    }
};
</script>

<style lang="scss" scoped>
svg.feather {
    height: 1em;
    margin-top: -4px;
    pointer-events: none;
    vertical-align: middle;
    width: 1em;
    background: transparent;
}
.edit-icon {
    color: green;
}
.filer-icon{
    color: black;
    margin-bottom: 5px;
}
.search-component{
    text-align: center;
}
</style>

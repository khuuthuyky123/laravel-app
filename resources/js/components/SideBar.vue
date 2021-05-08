<template>
    <div class="row">
        <nav
            id="sidebarMenu"
            class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
            style="height: 90vh;"
        >
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            @click="page = 'profile'"
                            href="#"
                        >
                            <HomeIcon></HomeIcon>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item" v-if="this.$cookies.get('userinfo')['role_id']=='4'">
                        <a class="nav-link" @click="page = 'user'" href="#">
                            <FileIcon></FileIcon>
                            Users
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main
            class="col-md-9 ms-sm-auto col-lg-10 px-md-4"
            v-if="page == 'user'"
        >
            <UsersTable></UsersTable>
        </main>
        <main
            class="col-md-9 ms-sm-auto col-lg-10 px-md-4"
            v-if="page == 'profile'"
        ></main>
    </div>
</template>
<script>

import { FileIcon } from "vue-feather-icons";
import { HomeIcon } from "vue-feather-icons";
import UsersTable from "./UsersTable.vue";
export default {
    components: {
        FileIcon,
        HomeIcon,
        UsersTable
    },
    data() {
        return {
            page: "profile",
        };
    },
    created(){
        this.getUserAuthed();
        
    },
    methods: {
        async getUserAuthed() {
            // it gets the cookie called `username`
            const res = await axios.post('/userinfo');
            const data = res.data;
            console.log(data);
            
            this.$cookies.set("userinfo",data,120)
        }
    }
};
</script>
<style lang="scss" scoped></style>

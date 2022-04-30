<template>
    <div class="header">
        <div class="header-menu">
            <div class="leftLines" @click="showL = !showL;showR = !showR">
                <div :class="showL ? 'activeLeft' : ''">
                    <span id="firstSpan" class="span"></span>
                    <span id="secondSpan" class="span"></span>
                    <span id="thirdSpan" class="span"></span>
                </div>
            </div>
        </div>
        <div class="header-logo">
            <img src="/images/logo2.png" alt="" class="logo">
        </div>
        <div class="header-actions">
            <div class="languages">
                <div class="language">LT </div>| 
                <div class="language"> EN</div>
            </div>
            <div class="login-logout">
                <router-link v-if="!authenticated" :to="'/login'">
                    <button class="header-button">prisijungti</button>                
                </router-link>
                <button v-else class="header-button" @click="logout">atsijungti</button>
            </div>
        </div>
        <div class="showHideRight" @click="showR = !showR;showL = false">
        ...
        </div>    
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data () {
        return {
            showL: false,
            showR: false
        }
    }, 
    computed: {
        authenticated(){
            return this.$store.getters['auth/authenticated'];
        },
        user(){
            return this.$store.getters['auth/user'];
        },
        userRole(){
            return this.user ? this.user.role_id : 0
        }
    },
    methods:{
        ...mapActions({
            signOut:'auth/logout'
        }),
        logout(){
            this.signOut()
        }
    }
}
</script>
<style>
    .header {
        background: linear-gradient(to top,rgba(255, 255, 255, 0) 0,rgba(255, 255, 255, 1) 10%,rgba(255, 255, 255, 1) 100%);
        color: #444;
        height: 70px;
        font-size: 16px;
        font-family: "Open Sans", sans-serif;
        /* border-bottom: 1px solid #e7e7e7; */
        display: flex;
        justify-content: space-between;
        padding: 0 1vw;
        z-index: 1;
        opacity: 0.96;
    }
    .header-menu {
        width: 35%;
        display: flex;
    }
    .leftLines {
        margin-top: 25px;
        margin-left: 1vw;
    }
    .span {
        background: #0f3075;
        display: block;
        width: 25px;
        height: 2px;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: all .2s linear;
    }
    .activeLeft .span:first-child {
        transform: translateY(5px) rotate(-45deg) scalex(1.3);
    }
    .activeLeft .span:nth-child(2) {
        height: 0;
        transition: all .05s linear;
    }
    .activeLeft .span:nth-child(3) {
        transform: translateY(-3px) rotate(45deg) scalex(1.3);
    }
    .header-logo {
        /* width: 35%; */
        justify-content: end;
    }
    .logo {
        height: 60px;
        margin: 5px 0;
        /* margin-right: 5vw; */
        float: right;
    }
    .header-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 20px;
        font-family: "Oswald", sans-serif;
        font-size: 16px;
        font-weight: 300;
        letter-spacing: 0.03em;
        width: 35%;
    }
    .showHideRight {
        display: none;
    }
    .languages {
        margin: 0 0.2em;
        display: flex;
    }
    .language {
        margin: 0 0.2em;
        cursor: pointer;
        height: 22px;
    }
    .login-logout {
        padding: 0 0.2em;
    }
    .login-logout:hover {
        color: #a85727;
    }
    .language:hover {
        color: #a85727;
        border-bottom: 1.5px solid rgba(168, 86, 39, 0.7);
    }
    .header-button {
        border: 1.5px solid rgba(168, 86, 39, 0.5);
        border-radius: 5px;
        margin: 0 0.2em;
        padding: 0.2em 0.5em;
        text-transform: uppercase;
        color: #a85727;
        background-color: #fff;
        font-size: 14px;
        font-family: "Oswald", sans-serif;
        font-weight: 300;
        letter-spacing: 0.02em;
    }
    .header-button:hover {
        border: 1.5px solid rgba(168, 86, 39, 0.7);
        box-shadow: 0 0 5px rgba(168, 86, 39, 0.2);
    }
    @media only screen and (max-width: 800px) {
        .header-actions {
            display: none;
        }
        .showHideRight {
            display: block;
            transform: rotate(90deg);
            height: 10px;
            margin-top: 30px;
            width: fit-content;
            font-size: 30px;
        }
        .header-menu {
            width: 10%;
        }
        .header-logo {
            margin-right: 10vw;
        }.leftLines {
            margin-left: 2vw;
        }
    }
</style>
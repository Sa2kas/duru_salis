<template>
    <div class="header">
        <div class="header-menu">
            <div class="leftLines" @click="showL = !showL;showR = false">
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
                <div :class="$i18n.locale == 'lt' ? 'language-selected' : 'language'" @click="changeLang('lt')">LT </div>| 
                <div :class="$i18n.locale == 'en' ? 'language-selected' : 'language'" @click="changeLang('en')"> EN</div>
            </div>
            <div class="login-logout">
                <router-link v-if="!authenticated" :to="'/login'">
                    <button class="header-button">{{ $t("header.login") }}</button>                
                </router-link>
                <button v-else class="header-button" @click="logout">{{ $t("header.logout") }}</button>
            </div>
        </div>
        <div class="showHideRight" @click="showR = !showR;showL = false">
        ...
        </div>
        <div class="small-left-side">
            <div class="fixed-nav" :style="[!showL ? {'max-width': '0px', 'min-width': '0px'} : {}]">
                <left-side/>
            </div>
        </div>
        <div class="small-right-side" :style="[!showR ? {'max-width': '0px', 'min-width': '0px'} : {}]">
            <right-side/>            
        </div>
        <div class="menu-overlay" :style="[showR || showL ? {'visibility': 'visible', 'opacity': '0.6'} : {}]" @click="closeSide"/>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import LeftSide from '../components/LeftSide.vue'
import RightSide from '../components/RightSide.vue'
export default {
    components: {
        LeftSide,
        RightSide
    },
    data () {
        return {
            showL: false,
            showR: false,
            language: ''
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
        },
        routeName() {
            return this.$route.name;
        }
    },
    methods:{
        ...mapActions({
            signOut:'auth/logout'
        }),
        logout(){
            this.signOut()
        },
        changeLang(lang) {
            this.language = lang
            this.$i18n.locale = this.language
        },
        closeSide() {
            this.showR = false
            this.showL = false
        }
    },
    mounted() {
        if (localStorage.language) {
            this.language = localStorage.language 
            this.$i18n.locale = localStorage.language        
        }
    },
    watch: {
        language(newLanguage) {
            localStorage.language = newLanguage
            this.$i18n.locale = localStorage.language
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
        opacity: 0.975;
        position: relative, fixed;
    }
    .header-menu {
        width: 35%;
        display: flex;
    }
    .leftLines {
        margin-top: 25px;
        margin-left: 1vw;
        cursor: pointer;
        z-index: 5;
    }
    .span {
        background: rgba(68, 68, 68, 0.9);
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
    .language-selected {
        margin: 0 0.2em;
        cursor: pointer;
        height: 22px;
        color: #723B1B;
        border-bottom: 1.5px solid rgba(114, 59, 27, 0.7);
    }
    .login-logout {
        padding: 0 0.2em;
    }
    .header-button {
        border: 1.5px solid rgba(114, 59, 27, 0.5);
        border-radius: 5px;
        margin: 0 0.2em;
        padding: 0.2em 0.5em;
        text-transform: uppercase;
        color: #723B1B;
        background-color: #fff;
        font-size: 14px;
        font-family: "Oswald", sans-serif;
        font-weight: 300;
        letter-spacing: 0.02em;
    }
    .header-button:hover {
        border: 1.5px solid rgba(114, 59, 27, 0.7);
        box-shadow: 0 0 5px rgba(114, 59, 27, 0.2);
    }
    .small-left-side {
        position: fixed;
        /* width: 100vw; */
        /* max-width: 0px; */
        z-index: 4;
        height: 100vh;
        display: flex;
    }
    .fixed-nav {
        height: calc(100vh - 65px);
        overflow: hidden;
        position: absolute;
        min-width: 350px;
        max-width: 350vw;
        transition: max-width .3s ease-in, min-width .3s ease-in;
        display: flex;
        top: 64px;
        left: -1vw;
    }
    .small-right-side {
        top: 64px;
        z-index: 1;
        transition: max-width .3s ease-in, min-width .3s ease-in;
        position: absolute;
        right: 0;
        justify-content: space-between;
        display: flex;
        height: calc(100vh - 65px);
        min-width: 300px;
        max-width: 300px;
        background: #f7f7f7;
    }
    .menu-overlay {
        transition: visibility .3s linear,opacity .3s linear;
        visibility: hidden;
        background: #000;
        opacity: 0;
        width: 100%;
        height: calc(100vh - 65px);
        display: block;
        top: 65px;
        left: 0;
        position: fixed;
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
            cursor: pointer;
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
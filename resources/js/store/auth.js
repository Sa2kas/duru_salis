import axios from 'axios'
import router from '../router'

export default {
    namespaced: true,
    state:{
        authenticated:false,
        user:{}
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_USER (state, value) {
            state.user = value
        }
    },
    actions:{
        login({commit}){
            return axios.get('/api/user').then(({data})=>{
                commit('SET_USER',data)
                commit('SET_AUTHENTICATED',true)
                switch(data.role_id){
                    case 1:
                        router.push({name:'dashboard'})
                        break;
                    case 2:
                        router.push({name:'manager_dashboard'})
                        break;
                    case 3:
                        router.push({name:'product_manager_dashboard'})
                        break;   
                }               
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        logout({commit}){
            axios.post('/logout')
            .then(response => {
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
                router.push({name:'home'})
            })
           
        }
    }
}

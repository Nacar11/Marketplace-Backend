import {createStore} from "vuex";
import api from '../api'

const store  = createStore({
    state:{
        user:{
            data: {username: ''},
            token: sessionStorage.getItem('Token'),
        }
    },
    getters:{},
    actions:{
        register({}, user){
            return api.post('/register', user).then(({data}) => {
                return data;
            })
        },
        login({commit}, user){
            console.log(user)
            return api.post('/login', user).then(({data}) => {
                commit('setUser', data)
                return data;
            })
        },
        getProductCategories({}){
            return api.get('/product-category').then(({data}) => {
                return data;
            })
        },
        logout({commit}){
            return api.get('/logout').then(data => {
                console.log("asda")
                commit('logout') 
                return data;
            })
        },
        getProductItems({}){
            return api.get('/product-item').then(({data}) => {
                return data;
            })
        },
        getProductTypes({}){
            return api.get('/product').then(({data}) => {
                return data;
            })
        },
    },
    mutations:{
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem('Token')
        },
        setUser: (state, userData) => {
            state.user.token = userData.access_token;
            state.user.data.username = userData.username;
            sessionStorage.setItem('Token', userData.access_token);
        }
    },
    modules:{}

})


export default store; 
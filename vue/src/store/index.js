import {createStore} from "vuex";
import api from '../api'

const store  = createStore({
    state:{
        user:{
            data: {
                username: '',
                userID: sessionStorage.getItem('userID'),
            },
            token: sessionStorage.getItem('Token'),
        },
        product_categories:{
            data: "",

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
        addProductItem({commit},details){
            console.log(details)
            return api.post('/product-item', details).then(({data}) => {
                return data;
            })
        },
        getProductCategories({commit}){
            return api.get('/product-category').then(({data}) => {
                commit('setProductCategories', data)
                return data;
            })
        },
        logout({commit}){
            return api.get('/logout').then(data => {
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
        getVariantsByProductTypes({},id){
            return api.get(`/getVariantsByProductTypes/${id}`).then(({data}) => {
                return data;
            })
        },
        async getAllVariationOptions({}){
            return await api.get('/variation-option').then(({data}) => {
                return data;
            })
        },
        async addProductConfiguration({},form){
            return await api.post('/product-configuration',form).then(({data}) => {
                return data;
            })
        },
        async getProductItemByCategory({},id){
            return await api.get(`/getProductItemByCategory/${id}`).then(({data}) => {
                return data;
            })
        },
        async getShoppingCartByUser({},id){
            return await api.get(`/getShoppingCartByUser/${id}`).then(({data}) => {
                return data;
        })
         },
        async addToCart({},form){
            return await api.post(`/addToCart`,form).then(({data}) => {
                return data;
        })
         },
        async deleteShoppingCartItemByCart({},formIDs){
            return await api.delete(`/deleteShoppingCartItemByCart/${formIDs.itemID}/${formIDs.cartID}`).then(({data}) => {
                return data;
        })
         },
         async getUser({}){
            console.log(store.state.user.data.userID)
            return await api.get(`/getUser/${store.state.user.data.userID}`).then(({data}) => {
                return data;
        })
         },
    },
    mutations:{
        setProductCategories: (state, product_categories) =>{
            state.product_categories.data =  product_categories
        },

        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem('Token')
        },
         setUser: (state, userData) => {
            state.user.token = userData.access_token;
            state.user.data.username = userData.username;
            state.user.data.userID = userData.user_id;
            sessionStorage.setItem('Token', userData.access_token);
            sessionStorage.setItem('userID', userData.user_id);
        }
    },
    modules:{}

})


export default store; 
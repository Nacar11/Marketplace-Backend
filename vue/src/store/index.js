import {createStore} from "vuex";
import api from '../api'

const organizeCategories = (data) => {
    const categoriesMap = new Map();
    const result = [];
  
    data.forEach((category) => {
      if (!category.category_id) {
        result.push(category);
      } else {
        const parentCategory = categoriesMap.get(category.category_id);
        if (!parentCategory.children) {
          parentCategory.children = [];
        }
        parentCategory.children.push(category);
      }
  
      categoriesMap.set(category.id, category);
    });
    return result;
  };

const store  = createStore({
    state:{
        user:{
            data: {
                username: '',
                userID: sessionStorage.getItem('userID'),
                userPic: '',
                userFirstName: sessionStorage.getItem('FirstName'),
                userLastName: sessionStorage.getItem('LastName'),
                userEmail: sessionStorage.getItem('Email'),
                googleID: sessionStorage.getItem('googleID')

            },
            token: sessionStorage.getItem('Token'),
        },
        product_categories:{
            data: "",
        },
        organizedCategories:[],
        filteredProductItems:[],
    },
    getters: {
        organizedCategories: (state) => state.organizedCategories,
        filteredProductItems: (state) => state.filteredProductItems,
        userID: (state) => state.user.data.userID,

      },
    actions:{
        register({commit}, user){
            return api.post('/register', user).then(({data}) => {
                sessionStorage.clear();
                commit('setUser', data)
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
        facebookLogin({commit}, userData){
            console.log(userData)
            return api.post('/facebook/callback', userData).then(({data}) => {
                console.log(data)
                return data;
            })
        },
        googleLogin({commit}, user){
            console.log(user.email)
            return api.post('/google/callback', user).then(({data}) => {
                if(data.message === 'Success'){
                    commit('setUser', data)
                }
                return data;
            })
        },
        addProductItem({commit},details){
            console.log(details)
            return api.post('/productItem', details).then(({data}) => {
                return data;
            })
        },
        getProductCategories({commit}){
            return api.get('/product-category').then(({data}) => {
                const organizedCategories = organizeCategories(data);
                commit('setOrganizedCategories', organizedCategories);
            })
        },
        logout({commit}){
            return api.get('/logout').then(data => {
                commit('logout') 
                return data;
            })
        },
        getProductItems({}){
            return api.get('/productItems').then(({data}) => {
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
        async getProductItemsByCategory({commit},id){
            return await api.get(`/productItemsbyCategory/${id}`).then(({data}) => {
                console.log(data)
                commit('setFilteredProductItems', data.Body);

                return data;
            })
        },

        async getShoppingCartByUser({},id){
            return await api.get(`/getShoppingCartByUser/${id}`).then(({data}) => {
                return data;
        })
         },
        async addToCart({},id){
            console.log(id)
            return await api.post(`/addToCart`,id).then(({data}) => {
                return data;
        })
         },
        async deleteShoppingCartItemByCart({},formIDs){
            return await api.delete(`/deleteShoppingCartItemByCart/${formIDs.itemID}/${formIDs.cartID}`).then(({data}) => {
                return data;
        })
         },
         async getUser({}){
            return await api.get(`/getUser/`).then(({data}) => {
                return data;
        })
         },
         async getCountries({}){
            return await api.get(`/countries`).then(({data}) => {
                return data;
        })
         },
         async addAddress({}, details){
            return await api.post(`/addAddress`, details).then(({data}) => {
                return data;
        })
         },
         async getAddress({}){
            return await api.get(`/getAddress`).then(({data}) => {
                return data;
        })
         },
         async deleteAddress({}, id){
            return await api.delete(`/deleteAddress/${id}`).then(({data}) => {
                return data;
        })
         },
         async getPaymentTypes({}){
            return await api.get(`/paymentTypes`).then(({data}) => {
                return data;
        })
         },
         async getUPMbyID({}){
            return await api.get(`/getUPMbyID`).then(({data}) => {
                return data;
        })
         },
         async updateUPM({},data){
            console.log(data)
            return await api.put(`/updateUPM`,data).then(({data}) => {
                return data;
        })
         },
         async getFirstShipping({}){
            return await api.get(`/getFirstShipping`).then(({data}) => {
                return data;
        })
         },
         async addShopOrder({}, form){
            return await api.post(`/addShopOrder`, form).then(({data}) => {
                return data;
        })
         },
         async addOrderLine({}, form){
            return await api.post(`/addOrderLine`, form).then(({data}) => {
                return data;
        })
         },
         async getShopOrderByID({}){
            return await api.get(`/getShopOrderByID`).then(({data}) => {
                return data;
        })
         },
         async getOrdersReceived({}){
            return await api.get(`/getOrderlinesFromProductListings`).then(({data}) => {
                return data;
        })
         },
         async getProductItemFullDetails({}, id){
            return await api.get(`/getProductItem/${id}`).then(({data}) => {
                return data;
        })
         },
    },
    mutations:{
        setUserToRegister: (state, userData) => {
            state.user.data.userFirstName = userData.given_name
            sessionStorage.setItem('FirstName', userData.given_name)
            state.user.data.userLastName = userData.family_name
            sessionStorage.setItem('LastName', userData.family_name)
            state.user.data.userEmail = userData.email
            sessionStorage.setItem('Email', userData.email)
            state.user.data.googleID = userData.sub
            sessionStorage.setItem('googleID', userData.sub)
            sessionStorage.setItem('LoginMethod', 'google')
        },

        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.clear();
        },
         setUser: (state, userData) => {
            state.user.token = userData.access_token;
            state.user.data.username = userData.username;
            state.user.data.userID = userData.user_id;
            sessionStorage.setItem('Token', userData.access_token);
            sessionStorage.setItem('userID', userData.user_id);
        },
        setOrganizedCategories(state, categories) {
            state.organizedCategories = categories;
          },
        setFilteredProductItems(state, data) {
            state.filteredProductItems = data;
          },
    },
    modules:{}

})


export default store; 
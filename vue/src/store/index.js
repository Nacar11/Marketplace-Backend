import {createStore} from "vuex";


const store  = createStore({
    state:{
        users:{
            data: {name: ''},
            token: null,
        }
    },
    getters:{},
    actions:{},
    mutations:{},
    modules:{}

})


export default store; 
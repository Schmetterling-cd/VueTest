export default{
    namespaced: true,
    state:{
        types : [],
    },
    getters:{
        getTypes(state){
            return state.types;
        }
    },
    mutations:{
        setTypes(state, data){
            state.types = data;
        }
    },
    actions:{
        fetchTypes({state, commit}){
            return axios.get('/fetchTypes')
                .then((response)=>{
                    console.log(response.data)
                    commit('setTypes', response.data);
                });
        }
    },
}
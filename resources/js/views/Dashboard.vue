<template>
  <div class="container ">
      <div class="d-flex justify-content-center p-3">
        <div class="col-5 bg-white border m-1 p-3">
          <form ref="formClient" @submit.prevent="saveClient" action="" method="post">
            <div class="form-group mt-3">
              <label for="name">Name</label>
              <input class="form-control form-control-sm" placeholder="Ex: Client A" v-model="name" type="text">
            </div>

            <div class="form-group mt-3">
              <label for="">Redirect URL</label>
              <input class="form-control form-control-sm" placeholder="http://localhost:9000/callback" v-model="redirect_url" type="text">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn mt-3 btn-success btn-sm">Create Client</button>

            </div>
          </form>
        </div>
        <div class="col-7 bg-white border m-1 p-3 elevation-1">
          <label for="Clients">Clients</label>
          <div v-for="(client, index) in clients" :key="index" class="alert alert-secondary mt-2 d-flex flex-column" role="alert">
            <span>ID: <span class="badge badge-warning text-success">{{client.id}}</span></span>
            <span>NAME: <span class="badge badge-warning text-success">{{ client.name }}</span></span>
            <span>SECRET: <span class="badge badge-warning text-success">{{ client.secret }}</span></span>
            <span>REDIRECT URL: <span class="badge badge-warning text-success"><a :href="client.redirect">{{ client.redirect }}</a> </span></span>
            <span>REVOKED: <span class="badge badge-warning text-success">{{ client.revoked }}</span></span>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data() {
      return {
        name: '',
        redirect_url: '',
        clients: []
      }
    },
    methods: {
      getClients() {
        axios.get('/oauth/clients')
          .then((response) => {
            this.clients = response.data
          })
          .catch(error => {
            console.log('Something Went wrong.');
          })
      },
      saveClient() {
        axios.post('/oauth/clients', {
          name: this.name,
          redirect: this.redirect_url
        })
        .then(response => {
          this.getClients()
          this.$refs.formClient.reset()
          alert('all good')
        })
        .catch(error => {
          console.log('Something Went wrong.');
        })
      },
      generateToken(info) {
        axios.post('/start-login', info)
          .then(response => {
            console.log('Processing...');
          })
          .catch(error => {
            console.log('Something Went wrong.');
          })
      }
    },
    mounted() {
      this.getClients()
    }
  };
</script>
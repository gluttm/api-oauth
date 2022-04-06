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
              <input class="form-control form-control-sm" placeholder="http://localhost:9000/callback" v-model="redirect_uri" type="text">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn mt-3 btn-success btn-sm">Create Client</button>

            </div>
          </form>
          <div v-if="a_token" class="mt-3">
            <label for="">Access Token</label>
          <textarea disabled v-model="a_token" class="form-control" name="" id="" cols="30" rows="10"></textarea>

          </div>
        </div>
        <div class="col-7 bg-white border m-1 p-3 elevation-1">
          <label for="Clients">Clients</label>
          <div v-for="(client, index) in clients" :key="index" class="alert alert-secondary mt-2 d-flex flex-column" role="alert">
            <span>ID: <span class="badge badge-warning text-success">{{client.id}}</span></span>
            <span>NAME: <span class="badge badge-warning text-success">{{ client.name }}</span></span>
            <span>SECRET: <span class="badge badge-warning text-success">{{ client.secret }}</span></span>
            <span>REDIRECT URL: <span class="badge badge-warning text-success"><a :href="client.redirect">{{ client.redirect }}</a> </span></span>
            <span>REVOKED: <span class="badge badge-warning text-success">{{ client.revoked }}</span></span>
            
            <a :href="`
                  ${api_url}start-login?client_id=${client.id}&redirect_uri=${client.redirect}&response_type=code&scope=&client_secret=${client.secret}`" class="btn btn-info">Generate Token</a>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import {apiUrl} from '../../../common'

  export default {
    props: ['access_token'],
    data() {
      return {
        name: '',
        redirect_uri: '',
        clients: [],
        a_token: this.access_token.access_token,
        api_url: apiUrl,
      }
    },
    methods: {
      getClients() {
        axios.get(this.api_url+'oauth/clients')
          .then((response) => {
            this.clients = response.data
          })
          .catch(error => {
            console.log('Something Went wrong.')
          })
      },
      saveClient() {
        axios.post(this.api_url+'oauth/clients', {
          name: this.name,
          redirect: this.redirect_uri
        })
        .then(response => {
          this.getClients()
          this.$refs.formClient.reset()
        })
        .catch(error => {
          console.log('Something Went wrong.')
        })
      }
    },
    mounted() {
      this.getClients()
    }
  }
</script>
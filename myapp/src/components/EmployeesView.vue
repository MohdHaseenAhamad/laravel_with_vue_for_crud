<template>
  <div>
    <div class="container" style="margin-top: 50px">

      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <h3>Employees Form</h3>
          <div v-if=" massage.success == true ">
          <div class="alert alert-success" role="alert">
            {{massage.msg}}
          </div>
          </div>
          <div v-else-if=" massage.success == false ">
            <div class="alert alert-danger" role="alert">
              {{massage.msg}}
            </div>
          </div>

          <form @submit.prevent="save">
            <div class="form-group">
              <label for="name">Employees Name</label>
              <input type="text" class="form-control" v-model="employee.name" name="name" id="name" placeholder="Employees Name">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="address">Employees Address</label>
              <input type="text" class="form-control" name="address" v-model="employee.address" id="address" placeholder="Employees Address">
            </div>
            <div class="form-group">
              <label for="mobile">Employees Mobile</label>
              <input type="text" class="form-control" name="mobile" v-model="employee.mobile" id="mobile" placeholder="Employees Mobile">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
    <div class="container" style="margin-top: 50px">
      <div class="row">
        <div class="col-md-12">
          <h3>Employees list</h3>
          <table class="table">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Mobile</th>
              <th scope="col">Option</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in result" v-bind:key="employee.empoyeeId">
              <th scope="row">{{employee.id}}</th>
              <td>{{employee.name}}</td>
              <td>{{employee.address}}</td>
              <td>{{employee.mobile}}</td>
              <td>
                <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
                <button type="button" class="btn btn-danger" @click="remove(employee)">Delete</button>
              </td>
            </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue';
  import axios from 'axios';

  Vue.use(axios)
  export default {
    name: 'EmployeesView',
    data() {
      return {
        result: {},
        massage:{},
        employee:{
          id:'',
          name:'',
          address:'',
          mobile:''
        }
      }
    },
    created() {
      this.EmployeesLoad();
    },
    methods: {
      EmployeesLoad() {
        // console.log("sample");
        var page = "http://127.0.0.1:8000/api/employees";
        axios.get(page).then(
          ({data}) => {
            console.log(data);
            this.result = data;
          }
        );
      },
      save()
      {
        if(this.employee.id == '')
        {
          this.saveData();
        }else
        {
          this.updateData();
        }


      },
      saveData()
      {
        axios.post("http://127.0.0.1:8000/api/save",this.employee).then(
          ({data})=>{
            console.log(data);
            if(data.success==true)
            {
              this.massage = data;
              this.EmployeesLoad();
            }else {

            }

          }
        );
      },
      edit(employee)
      {
        this.employee = employee;
      },
      updateData()
      {
        axios.post("http://127.0.0.1:8000/api/update/"+this.employee.id,this.employee).then(
          ({data})=>{
            if(data.success==true)
            {
             this.employee.name = '';
             this.employee.address = '';
             this.employee.mobile = '';
             this.id = '';
             this.massage = data;
             this.EmployeesLoad();
            }else {

            }

          }
        );
      },
      remove(employee)
      {
        axios.post("http://127.0.0.1:8000/api/delete/"+employee.id).then(
          ({data})=>{
            if(data.success==true)
            {
              this.massage = data;
              this.EmployeesLoad();
            }else {

            }

          }
        );
      },
      deleteData()
      {

      }
    }
  }
</script>



<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createEmployee'}" class="btn btn-success">Добавить</router-link>
            <select v-model="selected">
                <option>
                    Все
                </option>
                <option v-for="department in departments" v-bind:value="department.id">
                    {{ department.name }}
                </option>
            </select>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Список сотрудников</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Отдел</th>
                        <th>Должность</th>
                        <th>Руководитель</th>
                        <th>Телефон</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="employee, index in filteredList">
                        <td>{{ employee.name }}</td>
                        <td v-if="employee.department">
                            {{ employee.department.name }}
                        </td>
                        <td v-else>
                        </td>
                        <td>{{ employee.position.name }}</td>
                        <td v-if="employee.head">
                            {{ employee.head.name }}
                        </td>
                        <td v-else>
                        </td>
                        <td>{{ employee.contact.phone }}</td>
                        <td>
                            <router-link :to="{name: 'editEmployee', params: {id: employee.id}}" class="btn btn-xs btn-default">
                                Редактировать
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(employee.id, index)">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                employees: [], 
                departments: [],
                selected: 'Все', 
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/employees')
                .then(function (resp) {
                    app.employees = resp.data.data
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load employees");
                });

    
            axios.get('/api/v1/departments')
                .then(function (resp) {
                    app.departments = resp.data
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load departments");
                });

            

        },
        computed:{
            filteredList: function(){
                var sel = this.selected;
                var app = this;
                return this.employees.filter(function (elem) {
                 
                    if(sel==='Все') 
                        return true;
                    else 
                        if(elem.department != null) {

                            return elem.department.id == sel;
                        }
                            
                        else
                            return false;
                })
            }
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/employees/' + id)
                        .then(function (resp) {
                            app.employees.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete employee");
                        });
                }
            }
        }
    }
</script>


<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <p v-if="errors.length">
                <b>Пожалуйста исправьте указанные ошибки:</b>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>
            <div class="panel-heading">Добавление нового сотрудника</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ФИО</label>
                            <input type="text" v-model="employee.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Отдел</label>
                            <select v-model="selectedDepartment">
                                <option v-bind:value="null">
                                    Пусто
                                </option>
                                <option v-for="department in departments" v-bind:value="department.id" v-bind:key="department.name">
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Должность</label>
                            <select v-model="selectedPosition">
                                <option v-for="position in positions" v-bind:value="position.id" v-bind:key="position.name">
                                    {{ position.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Руководитель</label>
                            <select v-model="selectedEmployee">
                                <option v-bind:value="null">
                                    Пусто
                                </option>
                                <option v-for="employee in employees" v-bind:value="employee.id" v-bind:key="employee.name">
                                    {{ employee.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Телефон</label>
                            <input type="text" v-model="contact.phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Изменить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import mixins from './mixins/mixins.js';

    export default {
        mixins: [mixins],
        data: function () {
            return {
                employeeId: null,
                employee: {
                    name: '',
                    department: [],
                    position: [],
                    head: [],
                    department_id: '',
                    position_id: '',
                    head_id: '',
                    
                },
                contact: {
                    phone: '',
                },
                departments: [],
                positions: [],
                employees: [],
                selectedPosition: '',
                selectedDepartment: '',
                selectedEmployee: '',
            }
        },
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.employeeId = id;

            axios.get('/api/v1/departments')
                .then(function (resp) {
                    app.departments = resp.data
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load departments");
                });

            axios.get('/api/v1/positions')
                .then(function (resp) {
                    app.positions = resp.data
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load positions");
                });

            axios.get('/api/v1/employees')
                .then(function (resp) {
                    app.employees = resp.data.data.filter(function(empl) {
                    return empl.id != app.employeeId;
                });
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load employees");
                });

            axios.get('/api/v1/employees/' + id)
                .then(function (resp) {
                    app.selectedPosition = resp.data.data.position!= null ? resp.data.data.position.id : null;
                    app.selectedEmployee = resp.data.data.head != null ? resp.data.data.head.id : null;
                    app.selectedDepartment = resp.data.data.department != null ? resp.data.data.department.id : null;
                    
                    app.employee = resp.data.data;
                    app.contact = resp.data.data.contact;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load your employee")
                });

        },
        
        methods: {
            saveForm() {
                if (this.checkForm())
                {
                    var app = this;
                    var newEmployee = app.employee;
                    newEmployee.position_id = app.selectedPosition;
                    newEmployee.department_id = app.selectedDepartment;
                    newEmployee.head_id = app.selectedEmployee;
                    axios.patch('/api/v1/employees/' + app.employeeId, newEmployee)
                        .then(function (resp) {
                            app.$router.replace('/');
                        })
                        .catch(function (resp) {
                            console.log(resp);
                            alert("Could not create your employee");
                        });
                }
            }
        }
    }
</script>

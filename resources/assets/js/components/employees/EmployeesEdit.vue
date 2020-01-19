
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Назад</router-link>
        </div>

        <div class="panel panel-default">
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
                            <select v-model="selected1">
                                <option v-bind:value="null">
                                    Пусто
                                </option>
                                <option v-for="department, key in departments" v-bind:value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Должность</label>
                            <select v-model="selected2">
                                <option v-for="position, key in positions" v-bind:value="position.id">
                                    {{ position.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Руководитель</label>
                            <select v-model="selected3">
                                <option v-bind:value="null">
                                    Пусто
                                </option>
                                <option v-for="employee, key in employees" v-bind:value="employee.id">
                                    {{ employee.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Телефон</label>
                            <input type="text" v-model="employee.phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.employeeId = id;
            axios.get('/api/v1/employees/' + id)
                .then(function (resp) {
                    console.log(resp.data.data);
                    app.selected2 = resp.data.data.department.name;
                    
                    app.employee = resp.data.data;
                })
                .catch(function () {
                    alert("Could not load your company")
                });
        },
        data: function () {
            return {
                employeeId: null,
                employee: {
                    name: '',
                    department_id: '',
                    position_id: '',
                    head_id: '',
                    phone: '',
                },
                departments: [],
                positions: [],
                employees: [],
                // selected1: this.,
                // selected2: this.,
                // selected3: this.,
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newEmployee = app.employee;
                newEmployee.position_id = app.selected2;
                newEmployee.department_id = app.selected1;
                newEmployee.head_id = app.selected3;
                console.log(newEmployee);
                axios.patch('/api/v1/employees/' + app.companyId, newCompany)
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
</script>

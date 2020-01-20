
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
                                <option v-for="(department) in departments" v-bind:key="department.name" v-bind:value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Должность</label>
                            <select v-model="selected2">
                                <option v-for="position in positions" v-bind:value="position.id" v-bind:key="position.name">
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
                                <option v-for="employee in employees" v-bind:key="employee.name" v-bind:value="employee.id">
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
        data: function () {
            return {
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
                selected1: -1,
                selected2: 1,
                selected3: -1,

            }
        },
         mounted() {
            var app = this;
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
                    app.employees = resp.data.data
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load employees");
                });
        },
        methods: {
            saveForm() {
                var app = this;
                var newEmployee = app.employee;
                newEmployee.position_id = app.selected2;
                newEmployee.department_id = app.selected1;
                newEmployee.head_id = app.selected3;
                console.log(newEmployee);
                axios.post('/api/v1/employees', newEmployee)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your employee");
                    });
            }
        }
    }
</script>

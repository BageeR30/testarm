export default {
    methods: {
        checkForm: function () {
            let employee = this.employee;
            let contact = this.contact;
            // employee.name = this.checkName(employee.name);
            // contact.phone = this.checkPhone(contact.phone);
            if ((employee.name) && (contact.phone)) {
                return true;
            }

            this.errors = [];

            if (!employee.name) {
                this.errors.push('Требуется указать имя.');
            }
            if (!contact.phone) {
                this.errors.push('Требуется указать номер телефона(11 цифр).');
            }

        },
        checkPhone: function(phone) {
            console.log(phone);
            var reg = new RegExp('/\+?\d{11}/s');
            return reg.exec(phone);
        },
        checkName: function(name) {
            console.log(name);
            var reg = new RegExp('/([а-яa-z\s]{3,30})/si');
            return reg.exec(name);
        }
    }
  }
var app = new Vue({
    el: '#app',
    data: {
        edit: false,
        message: '',
        address_books: [],
        cities: [],
        form: {
            id: '',
            name: '',
            first_name: '',
            email: '',
            city_id: '',
            street: '',
            zip_code: '',
        },

        errors: [],
    },
    created: function() {
        this.getAddressBooks();
        this.getCities();
    },
    methods: {
        addAddressModal() {
            this.edit = false
            $('#addressBookModal').modal('show')
            this.clearForm()
        },

        getAddressBooks() {
            axios.get('Controllers/AddressBookController.php')
                .then((response) => {
                    this.address_books = response.data
                })
        },

        getCities() {
            axios.get('Controllers/CityController.php')
                .then((response) => {
                    this.cities = response.data
                })
        },

        editAddress(addressBook) {
            $('#addressBookModal').modal('show')
            this.edit = true
            this.form.id = addressBook.id
            this.form.name = addressBook.name
            this.form.first_name = addressBook.first_name
            this.form.email = addressBook.email
            this.form.city_id = addressBook.city_id
            this.form.street = addressBook.street
            this.form.zip_code = addressBook.zip_code
        },

        saveAddressBook() {
            if (this.validateForm()) {
                const formDetails = new FormData()
                formDetails.append('name', this.form.name)
                formDetails.append('first_name', this.form.first_name)
                formDetails.append('email', this.form.email)
                formDetails.append('city_id', this.form.city_id)
                formDetails.append('street', this.form.street)
                formDetails.append('zip_code', this.form.zip_code)

                axios.post('Controllers/AddressBookController.php?action=create', formDetails)
                    .then((response) => {
                        console.log(response)
                        $('#addressBookModal').modal('hide')
                        this.getAddressBooks()
                        this.message = response.data
                    })
            } else {
                console.log('Sorry something went wrong')
            }
        },

        updateAddressBook() {
            if (this.validateForm()) {
                const formDetails = new FormData()
                formDetails.append('name', this.form.name)
                formDetails.append('id', this.form.id)
                formDetails.append('first_name', this.form.first_name)
                formDetails.append('email', this.form.email)
                formDetails.append('city_id', this.form.city_id)
                formDetails.append('street', this.form.street)
                formDetails.append('zip_code', this.form.zip_code)

                axios.post('Controllers/AddressBookController.php?action=update', formDetails)
                    .then((response) => {
                        $('#addressBookModal').modal('hide')
                        this.getAddressBooks()
                        this.message = response.data
                    })
            }
        },

        validateForm() {
            if (this.form.name && this.form.first_name && this.form.email && this.form.city_id && this.form.street && this.form.zip_code) {
                return true;
            }
        },

        clearForm() {
            this.form.name = ''
            this.form.first_name = ''
            this.form.email = ''
            this.form.city_id = ''
            this.form.street = ''
            this.form.zip_code = ''
        }
    }

})
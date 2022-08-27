<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <title>Address Book</title>
</head>

<body>
    <div id="app">
        <div class="container mt-5">
            <div class="alert alert-primary alert-dismissible fade show" role="alert" v-if="message">
            {{ message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h3>Address Books <a class="btn btn-primary float-end" @click="addAddressModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Address Book</a></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Street</th>
                                        <th scope="col">Zip Code</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="address_book in  address_books" v-bind:key="address_book.id">
                                        <th scope="row">{{ address_book['id']}}</th>
                                        <td>{{ address_book['name']}}</td>
                                        <td>{{ address_book['first_name']}}</td>
                                        <td>{{ address_book['email']}}</td>
                                        <td>{{ address_book['city']}}</td>
                                        <td>{{ address_book['street']}}</td>
                                        <td>{{ address_book['zip_code']}}</td>
                                        <td><a class="btn btn-success btn-sm" @click="editAddress(address_book)">Edit</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <form action="Controllers/ExportsController.php" method="POST">
                            <button class="btn btn-primary btn-sm" type="submit" name="export-data-to-json"><i class="fa fa-download" aria-hidden="true"></i> JSON</button>
                            <button type="submit" class="btn btn-primary btn-sm float-end" name="export-data-to-xml"> <i class="fa fa-download" aria-hidden="true"></i> XML</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Address Modal -->
        <div class="modal fade" id="addressBookModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Address Book Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" >
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name" v-model="form.name" name="name" placeholder="Name" required="">
                                <span v-if="!form.name" class="text-danger"> The name field is required</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" placeholder="First Name" v-model="form.first_name" name="first_name" required="">
                                <span v-if="!form.first_name" class="text-danger"> The first name field is required</span>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" v-model="form.email" id="email" placeholder="Email" name="email" required="">
                                <span v-if="!form.email" class="text-danger"> The email field is required</span>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="name" class="form-label">City</label>
                                <select class="form-select" v-model="form.city_id" aria-label="Default select example" name="city_id" required="">
                                 <option v-for="city in cities" v-bind:key="city.id" :value="city.id">{{ city.name }}</option>                                      
                          
                                </select>
                                <span v-if="!form.city_id" class="text-danger"> The city field is required</span>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="first_name" class="form-label">Street</label>
                                <input type="text" class="form-control" v-model="form.street" id="street" placeholder="street" name="street" required="">
                                <span v-if="!form.street" class="text-danger"> The street field is required</span>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zip-code" class="form-label">Zip Code</label>
                                <input type="zip_code" class="form-control" v-model="form.zip_code" id="zip_code" placeholder="Zip Code" name="zip_code" required="">
                                <span v-if="!form.zip_code" class="text-danger"> The zip code field is required</span>
                            </div>
                            <div class="col-md">
                                <button type="submit" class="btn btn-primary float-end" @click.prevent="updateAddressBook" v-if= "edit">Update Address</button>
                                <button type="submit" class="btn btn-primary float-end" @click.prevent="saveAddressBook" v-else >Save Address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="app.js"></script>

</body>

</html>
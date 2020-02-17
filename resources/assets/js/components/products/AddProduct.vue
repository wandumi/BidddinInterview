<template>
    <div class="col-lg-12 mt-2">
	  
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-left">Products</h3>
        
                <div class="pull-right">
                   
                    <button type="submit" class="btn btn-success" @click="addProduct">
                        Add Product <i class="fa fa-user-plus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th># </th>
                            <th>Product ID</th>
                            <th>name</th>
                            <th>sku</th>
                            <th>Price</th>
                            <th width='25%'>Description</th>
                            <th width='10%'>Bids</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <tr v-for="(product, key) in products.data" :key="product.id">
                            <td>{{ ++key }}</td>
                            <td>{{ product.id }}</td>
                            <td>{{ product.name | capWords }}</td>
                            <td>{{ product.sku }}</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.description }}</td>
                           
                            <td>
                                
                                <span class="badge badge-info">{{ product.bids_count }}</span>
                            </td>
                            <td>{{ product.created_at | formartDate }}</td>
                            <td>
                                <a href="#" @click="showProduct(product.id)" ><i class="fa fa-eye primary"></i></a> /
                                <a href="#" @click="editProduct(product)" ><i class="fa fa-edit primary"></i></a> /
                                <a href="#" @click="delProduct(product.id)" ><i class="fa fa-trash danger"></i></a>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!--/.footer -->
            <div class="card-footer">
                <span class="pull-left">
                    <!-- <h3>Pages</h3> -->
                </span>
                <span class="pull-right">
                    <pagination :data="products" @pagination-change-page="getResults"></pagination>
                </span>
            </div>
        </div>

        <!-- larg modal -->
        <div class="modal" id="products" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title h4" id="myLargeModalLabel">Add Product</h5>
                        <h5 v-show="editMode" class="modal-title h4" id="myLargeModalLabel">Update Product Info</h5>
                        <!-- <span v-if="loading" style="padding-left:30%;"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></span> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateProduct() : addProduct">
                    <!-- <form @submit.prevent="addProduct"> -->
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input v-model="form.sku" type="text" name="sku"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('sku') }">
                                    <has-error :form="form" field="sku"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input v-model="form.price" type="text" name="price"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                                    <has-error :form="form" field="price"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" name="description"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                
                                <!-- <div class="form-group">
                                     <label for="image">Product Image</label>
                                    <input type="file">
                                </div> -->
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editMode"   type="submit" class="btn btn-success">Update Product</button>
                            <button v-show="!editMode" @click="saveProduct" type="submit" class="btn btn-primary">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- larg modal -->
        <div class="modal" id="showProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title h4" id="myLargeModalLabel">Show Product</h5>
                        <h5 v-show="editMode" class="modal-title h4" id="myLargeModalLabel">Update Product Info</h5>
                        <!-- <span v-if="loading" style="padding-left:30%;"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></span> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                            <div class="col-md-12">
                                <h4>Bids</h4>
                            </div>
                            <div class="col-md-12">
                                
                            <table class="table table-stripped table-responsive">
                                <thead>
                                    <th>Email</th>
                                    <th>Price</th>
                                    <!-- <th>Lowest Bid</th> -->
                                </thead>
                                <tbody>
                                    <tr v-for="showproduct in showproducts" :key="showproduct.id">
                                        <td>{{ showproduct.email }}</td>
                                        <td>{{ showproduct.price }}</td>
                                        <!-- <td></td> -->
                                    </tr>
                                </tbody>
                            </table>
                                
                           
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                    </div>
                   
                </div>
            </div>
        </div>

        
    </div>
</template>
<script>
 
    
    export default {

        mounted() {
            console.log('Component mounted.');
            //load products
            this.loadProducts();
          
            Fire.$on('CreatedProduct',() => {
                this.loadProducts();
            });
        },

        data(){
            return{
                //pass the result form the database
                products: {},

                //result of show
                showproducts: {},

                //check if the edit mode is true or display createForm
                //true editing, false creating new one
                editMode: false,

                //form declarations
                form: new Form({
                    id:'',
                    name:'', 
                    sku:'', 
                    price:'', 
                    description:''
                }),
                
               
            }
        
        },

        methods: {
            
            // Our method to GET results from product api
            getResults(page = 1) {
                axios.get('/api/products?page=' + page)
                    .then(response => {
                        this.products = response.data;
                    });
            },

            // Load data from the database 
            loadProducts(){
               axios.get("/api/products")
                    .then(({data}) => (this.products = data));
            },

            // Show the modal after clicking the button to add new user
            addProduct(){
                this.editMode = false;
                this.form.reset();
                $('#products').modal('show');
            },

            //save data to the database
            saveProduct(){
                //start the progress bar
                this.$Progress.start();
                $('#products').modal('show');
                // Submit the form via a POST request
                this.form.post('api/products')
                    .then(({ data }) => { 
                        console.log(data) 
                        
                        //close the modal
                        $('#products').modal('hide');

                        //notification
                        toast.fire({
                            icon: 'success',
                            title: 'Added to the database successfully'
                        });

                        Fire.$emit('CreatedProduct');

                    })
                    .catch(() => {

                    });

                
                //finish the progress bar
                this.$Progress.finish();
            },

            //show modal to edit the user
            editProduct(product){
                this.editMode = true;
                this.form.reset();
                $('#products').modal('show');
                this.form.fill(product);
            },

            //update the product
            updateProduct(){
            //    console.log('editing data');
               this.$Progress.start();
               this.form.put('api/products/'+this.form.id)//user from the database 
                   .then(() => {
                       //successfully editted to the database
                       $('#products').modal('hide');
                       Swal.fire(
                            'Updated!',
                            'Your Product Infomation has been Updated.',
                            'success'
                        )
                        //finish the progress bar
                        this.$Progress.finish();

                        Fire.$emit('CreatedProduct');
                   })
                   .catch(() => {
                       //fail to update the product
                       this.$Progress.fail();
                        Swal.fire(
                            "Failed!",
                            "Failed to Update  the product.",
                            "warning"
                        )

                   });
            },

            

            //delete the product from the database
            delProduct(id){
                // alert('button clicked'+id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if(result.value)
                        {
                                 //delete the user using the package
                                this.form.delete('api/products/'+id)
                                 .then(() => {
                                    
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('CreatedProduct');
                                     
                                 })
                                 .catch(() => {
                                     Swal.fire(
                                        "Failed!",
                                        "Failed to delete the product.",
                                        "warning"
                                    )
                                 });
                        }

                    })
            
            },

             //show modal to edit the user
            showProduct(product){
            
                $('#showProduct').modal('show');

                   console.log('product');
               this.$Progress.start();
                axios.get('api/products/'+product)//user from the database 
                    .then(({data}) => {
                        //successfully editted to the database
                            this.showproducts = data;
                            //finish the progress bar
                            this.$Progress.finish();
                    });
                        

                
            },


        },

       
    }

</script>
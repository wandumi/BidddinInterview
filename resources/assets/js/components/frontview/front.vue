<template>
    <div>
        <div class="row">
            <div class="col-md-4" v-for="front in productCreated.data" :key="front.id">
                <div class="card mb-4 shadow-sm">
                <img class="card-img-top" data-src="../../../public/admin/dist/img/photo1.png" alt="Product Image">
                <div class="card-body">
                    <p class="card-text">{{ front.description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" @click="showpro(front.id)" class="btn btn-sm btn-outline-secondary">View</button>
                    </div>
                    <small>{{ front.created_at | formartDate }}</small>
                    <small class="text-muted outline-secondary">{{ front.price }}</small>
                    </div>
                </div>
                </div>
            </div> 
        </div>
         <div class="row">
            <span class="col-md-10">
                <h3></h3>
            </span>
            <span class="col-md-2 col-md-offset-3 pl-10">
                <pagination :data="productCreated" @pagination-change-page="getResults"></pagination>
            </span>
        </div>

        <!-- larg modal -->
        <div class="modal" id="showProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    
                        <h5 class="modal-title h4" id="myLargeModalLabel">Show Product | Bids | Bidding</h5>
                        <!-- <span v-if="loading" style="padding-left:30%;"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></span> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                
                
                    <div class="modal-body">
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <!-- <i class="fa fa-text-width"></i> -->
                                    Product 
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="list-group" v-for="product in oneProduct" :key="product.id">
                                        <li class="list-group-item">{{ product.name }}</li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- ./col -->
                            <div class="col-md-6">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <!-- <i class="fa fa-text-width"></i> -->
                                     Bids
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                   
                                </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            
                        </div>
                            

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">Your Bid</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <form @submit.prevent="saveBid">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input v-model="bid.email" type="text" name="email"
                                                        class="form-control" :class="{ 'is-invalid': bid.errors.has('email') }">
                                                    <has-error :form="bid" field="email"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input v-model="bid.price" type="text" name="price"
                                                        class="form-control" :class="{ 'is-invalid': bid.errors.has('price') }">
                                                    <has-error :form="bid" field="price"></has-error>
                                                </div>
                                                <div>
                                                    <input type="hidden" :value="bid.id" ref="bid.id">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success btn-block">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" @click="saveBid" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      
                    </div>
                   
                </div>
            </div>
        </div>
       
    </div>
</template>
<script>
    export default {

        mounted(){
            console.log('component mounted wandumi');
            this.getCreatedProducts();
            

            Fire.$on('savedBid',() => {
                this.getCreatedProducts();
            });
        },

        data(){
            return {
                productCreated: {},

                oneProduct: {},

                bid: new Form({
                    id: "",
                    email:"",
                    price:""
                })
            }
        },

        methods: {
            //get all the product to show the users
            getCreatedProducts(){
                axios.get("api/products")
                     .then(({data}) => {
                         this.productCreated = data;
                     });
            },

            //pagination for the results 
            getResults(page = 1) {
                axios.get('api/products?page=' + page)
                    .then(response => {
                        this.productCreated = response.data;
                    });
            },

            showpro(id){
                console.log(id);
                axios.get("api/products/"+id)
                     .then(({data}) => {
                         this.oneProduct = data.data;
                         $('#showProduct').modal('show');
                     })
            },

            saveBid(){
                this.bid.post("/bids")
                     .then(({ data }) => {
                         console.log(data) 
                        Fire.$emit('savedBid');
                        //close the modal
                        $('#showProduct').modal('show');

                        //notification
                        toast.fire({
                            icon: 'success',
                            title: 'You have Bidded successfully'
                        });
                       
                       
                     })
                     .catch((error) => {
                         Swal.fire(
                             "Failed!",
                             "There is an error, Please Cross Check!",
                             "warning"
                         )
                     });
            }

        }

    }
</script>
<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <section >
            <div class="container">
                <div class="row no-gutters top_pizza_box">
                    <div class="col-lg-6 ">
                        <h1 class="mb-4 mt-3">Delicious product</h1>
                        <p class="mb-4">Crispy, hot and for every taste! Fast delivery of classic product will help feed the whole company at a party, dine without leaving the office, or arrange delicious get-togethers over TV shows.</p>
                    </div>
                    <div class="col-lg-6 ">
                        <img class="one-third order-md-last img-fluid" src="/images/Pizza_picture.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class=" bg-light">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                    <div class="col-md-12 heading-section text-center ">
                        <h2 class="main_menu" >Menu</h2>
                        <!-- <p>Most beautiful products</p> -->
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-3  d-flex" v-for="product in products">
                        <div class="product d-flex flex-column">
                            <inertia-link :href="'/product/'+product.id" class="img-prod" >
                                <img class="img-fluid" :src="product.image_url" :alt="product.name">
                                <div class="overlay"></div>
                            </inertia-link>
                            <div class="text py-3 pb-4 px-3">
                                <h3><a href="#">{{product.name}}</a></h3>
                                <div class="pricing">
                                    <p class="price"><span>{{product.price}}{{product.sign}}</span></p>
                                </div>
                                <p class="bottom-area d-flex px-3">
                                    <a href="#" class="add-to-cart text-center py-2 mr-1" @click="addToCart($event, product.id)" ><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                                    <a href="#" class="buy-now text-center py-2" @click="buyNow($event, product.id)" >Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <Footer v-on:currency="currencyChange" />

    </div>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout';
    import HeaderNav from './../Common/HeaderNav';
    import Footer from './../Common/Footer';

    export default {
        props: [
            // 'products',
        ],
        components: {
            AppLayout,
            HeaderNav,
            Footer
        },
        data() {
            return {
                cart_items_count: 0,
                carts: {},
                products: {},
                currency: 'USD'
            }
        },
        mounted() {
            if ( this.$cookies.get('cart_items_count') !== null ){
                this.cart_items_count = this.$cookies.get('cart_items_count');
            }
            if ( this.$cookies.get('carts') !== null ){
                this.carts = this.$cookies.get('carts');
            }
            if ( this.$cookies.get('currency') !== null ){
                this.currency = this.$cookies.get('currency');
            }
            this.getProducts();
            // console.log(env.baseU);
            // console.log(env);
        },
        methods: {
            async getProducts() {
                const params = {
                    currency: this.currency
                };
                axios.get('/api/get_products', { params }).then(response => {
                    this.products = response.data;
                });
            },
            addToCart(event, product_id) {
                event.preventDefault();
                this.addItemInCart(product_id);
            },
            buyNow(event, product_id) {
                event.preventDefault();
                this.addItemInCart(producta_id);
                this.$inertia.visit('/cart');
            },
            addItemInCart(product_id) {
                this.cart_items_count++;
                this.$cookies.set('cart_items_count', this.cart_items_count);

                if ( Object.keys(this.carts).length > 0 ) {
                    let found = false;

                    for (let product_id_key in this.carts) {
                        if (product_id_key == product_id) {
                            this.carts[product_id_key]++;
                            found = true;
                        }
                    }
                    if ( ! found) {
                        this.carts = Object.assign(this.carts, {
                            [product_id]: 1
                        });
                    }

                } else {
                    this.carts = Object.assign(this.carts, {
                        [product_id]: 1
                    });
                }
                this.$cookies.set('carts', this.carts);
            },
            currencyChange(value) {
                this.currency = value;
                this.getProducts();
            },
        }
    }
</script>

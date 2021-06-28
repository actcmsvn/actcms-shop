<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_6.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 text-center">
                        <h1 class="mb-0 bread">{{product.name}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <section style="padding: 100px 0;" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 ">
                        <a :href="product.image_url" class="image-popup prod-img-bg"><img :src="product.image_url" class="img-fluid" :alt="product.name"></a>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ">
                        <h3>{{product.name}}</h3>
                        <p class="price"><span>{{product.sign}}{{product.price}}</span></p>
                        <p>{{product.description}}</p>
                        <p>
                            <a href="#" class="btn btn-black py-3 px-5 mr-2" @click="addToCart($event, product.id)" >Thêm vào giỏ hàng</a>
                            <a href="#" class="btn btn-primary py-3 px-5" @click="buyNow($event, product.id)" >Mua ngay</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <Footer v-on:currency="currencyChange" />

    </div>
</template>

<script>
    import HeaderNav from './../Common/HeaderNav';
    import Footer from './../Common/Footer';

    export default {
        components: {
            HeaderNav,
            Footer
        },
        data() {
            return {
                cart_items_count: 0,
                carts: {},
                product: {},
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
            this.getProduct();
        },
        methods: {
            async getProduct() {
                let product_id = window.location.href.split('/').pop();
                const params = {
                    currency: this.currency
                };
                axios.get('/api/get_product/'+product_id, { params }).then(response => {
                    this.product = response.data;
                });
            },
            addToCart(event, product_id) {
                event.preventDefault();
                this.addItemInCart(product_id);
            },
            buyNow(event, product_id) {
                event.preventDefault();
                this.addItemInCart(product_id);
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
                this.getProduct();
            },
        }
    }
</script>

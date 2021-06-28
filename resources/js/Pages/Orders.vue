<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />


        <section class="order_block bg-light">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                    <div class="col-md-12 heading-section text-center ">
                        <h2 class="main_menu" >Đơn hàng</h2>
                        <p>Lịch sử mua hàng</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" >

                        <table class="table" v-if="Object.keys(orders).length > 0" >
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Delivery</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Tổng</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody v-for="order in orders">
                            <tr >
                                <th scope="row">{{order.id}}</th>
                                <td>{{order.firstname}}</td>
                                <td>{{order.lastname}}</td>
                                <td>{{order.subtotal}}{{order.sign}}</td>
                                <td>}{{order.delivery}}{{order.sign}}</td>
                                <td>{{order.discount}}{{order.sign}}</td>
                                <td>{{order.total}}{{order.sign}}</td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="collapse" :href="'#collapse'+order.id" role="button" aria-expanded="false" :aria-controls="'#collapse'+order.id">
                                        Xem thêm
                                    </a>
                                </td>
                            </tr>
                            <tr class="collapse" :id="'collapse'+order.id">
                                <th></th>
                                <td><b>Address</b>: <br>{{order.address}}</td>
                                <td><b>Phone</b>: <br>{{order.phone}}</td>
                                <td><b>Email</b>: <br>{{order.email}}</td>
                                <td colspan="4">Order Items:</td>
                            </tr>
                            <tr class="collapse" :id="'collapse'+order.id" v-for="product in order.products">
                                <td colspan="4"></td>
                                <td><b>Product name</b>: <br>{{product.name}}</td>
                                <td><b>Price</b>: <br>{{product.price}}{{product.sign}}</td>
                                <td><b>Quantity</b>: <br>{{product.count}}</td>
                                <td><b>Total</b>: <br>{{product.total}}{{product.sign}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 v-else >Bạn chưa có đơn hàng nào.</h3>


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
             'user1',
        ],
        components: {
            AppLayout,
            HeaderNav,
            Footer
        },
        data() {
            return {
                user_id: 0,
                cart_items_count: 0,
                carts: {},
                currency: 'USD',
                orders: {}
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
            if (this.$page.user) {
                this.user_id = this.$page.user.id;
            }
            this.getOrders();
        },
        methods: {
            async getOrders() {
                const auth = {
                    headers: {
                        Accept: 'application/json',
                        Authorization: 'Bearer ' + this.$page.user_token,
                    },
                    params: {
                        user_id: this.$page.user.id,
                        currency: this.currency
                    }
                };
                axios.get('/api/get_user_orders', auth  ).then(response => {
                    if (response.data.success) {
                        this.orders = response.data.orders;
                    }
                });
            },
            currencyChange(value) {
                this.currency = value;
                this.getOrders();
            },
        }
    }
</script>

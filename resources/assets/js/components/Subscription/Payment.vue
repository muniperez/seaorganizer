<template>
   <div>
        <div class="card card-default text-center" >

            <div class="card-block">
                <h3>Only $2.49 / month</h3>

                <p class="lead" >
                    This is less than a coffee! :)<br/>
                </p>
            </div>

            <div class="card-block bg-primary text-white" v-if="selectedPlan">

                <div class="row">
                    <div class="col-md-6 offset-md-3">

                        <div class="form-group">
                            <label>Please provide your credit card information</label>
                            <card-component @change="change($event)" ></card-component>
                        </div>

                        <div class="form-group my-2" v-if="paid">
                            <p class="text-center text-success">
                                <i class="fa fa-check"></i> Payment accepted
                            </p>
                        </div>

                        <div class="form-group" v-else>
                            <button type="button" class='btn btn-success btn-lg' @click='pay' :disabled='!complete'>
                                Subscribe <i class="fa fa-spinner fa-spin" v-show="isProcessing" ></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-block" v-else>
                <button @click="selectedPlan = true" class="btn btn-primary btn-lg">Subscribe</button>
            </div>

            <div class="card-block" v-if="coupon.show">

                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        
                        <div v-if="!coupon.valid" >

                            <div class="input-group" >                        
                                
                                <input type="text" v-model="coupon.code" class="form-control" placeholder="Insert a coupon code" >

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" @click="checkCouponCode" :disabled="coupon.isProcessing" >
                                        Apply <i class="fa fa-spinner fa-spin" v-show="coupon.isProcessing"></i>
                                    </button>
                                </span>
                            </div>

                        </div>

                        <div class="form-group" v-else>
                            <p class="text-success"><i class="fa fa-check"></i> Coupon applied! (${{discountAmount}} off) </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-block" v-else>
                <h5>Have coupon code? <a href="#" @click="coupon.show = true">Click here to add</a></h5>
            </div>
            
            <div class="card-block">
                <p><small>Our payments are securely processed with Stripe. <i class="fa fa-cc-stripe"></i> <i class="fa fa-lock"></i></small></p>
                <small class="text-muted">(You will be charged $29.99 per year)</small>
            </div>
        </div>

    </div>

</template>

<script>

    import { Card, createToken } from 'vue-stripe-elements'

    export default {

        data()  {

            return {

                complete: false,
                isProcessing: false,
                paid: false,

                selectedPlan: null,
                selectedPlanName: null,
                errorMessage: null,

                paymentData: null,

                coupon: {

                    show: false,
                    code: null,
                    amount: null,
                    valid: false,
                    isProcessing: false
                },
            }

        },

        computed: {

            discountAmount()    {

                if(this.coupon.amount)    {

                    return this.coupon.amount / 100
                }

                return 0
            }

        },

        components: { Card },

        methods:    {

            pay () {

                this.complete = false
                this.isProcessing = true

                createToken().then(
                    
                    card => {

                            let payload = {token: card.token.id, plan: 'year'}

                            if(this.coupon.valid) {

                                payload.coupon = {code: this.coupon.code, amount: this.coupon.amount}
                            }

                            axios.post('/subscription/choose', payload).then(

                                data => {

                                    this.complete = true
                                    this.paid = true
                                    this.isProcessing = false

                                    window.location.href = "/onboarding"
                                }
                            )
                        }

                    )
            },

            change(event) {
                    
                if(event)    {

                    this.complete = event.complete
                }
            },

            checkCouponCode() {

                if(this.coupon.code)  {
                
                    let url = '/api/coupon/apply'
                    let payload = {code: this.coupon.code}

                    this.coupon.isProcessing = true

                    axios.post(url, payload).then(

                        response => {

                            this.coupon.valid = true
                            this.coupon.amount = response.data.amount
                            this.coupon.isProcessing = false
                        },

                        response => {

                            alert('Error: ' + response.message)

                            this.coupon.isProcessing = false
                        }
                    )
                }
            }
        },

        beforeMount()   {

            // Check if user has an invite code applied

            this.coupon.isProcessing = true

            axios.get('/api/coupon/check').then(

                response => {

                    if(response.data.code)   {

                        // Checks if code is valid
                        this.coupon.code = response.data.code
                        this.coupon.amount = response.data.amount
                        this.coupon.show = true

                        this.checkCouponCode()
                    }

                    this.coupon.isProcessing = false
                }
            )
        }
    }
</script>
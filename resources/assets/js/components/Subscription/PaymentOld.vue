<template>
   <div>
        <div class="card card-default">

            <div class="card-block">

                <div class="row" v-if="selected_plan">
                    <div class="col-lg-12 text-center">

                            <div class="form-group">
                                <label>Please provide your credit card information</label>
                                <card-component @change="change($event)" ></card-component>
                            </div>

                            <div class="form-group" v-if="paid">
                                <p class="text-center text-success">
                                    <i class="fa fa-check"></i> Payment accepted
                                </p>
                            </div>
                            <div class="form-group" v-else>
                                <button type="button" class='btn btn-success' @click='pay' :disabled='!complete'>
                                    Subscribe <i class="fa fa-spinner fa-spin" v-show="processing" ></i>
                                </button>
                            </div>
                    </div>
                </div>

                <div v-else>
                    <h3 class="text-center" >Choose your plan</h3>
                    <div class="row m-t-60" >
                        <div class="col-lg-6 m-b-10">
                            <div class="panel panel-default" :class="{ 'bg-primary': selected_plan_name == 'month'}" @click="selectPlan('month')">
                                <div class="panel-body text-center">
                                    <h4 class="m-t-5" >6 Months</h4>
                                    <p>$2.99 / month, charged every 6 months</p>

                                    <button type="button" class="btn btn-primary btn-lg btn-block" >
                                        Select
                                    </button>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="panel panel-default" :class="{ 'bg-primary' : selected_plan_name == 'year'}" @click="selectPlan('year')">
                                <div class="panel-body text-center">
                                    
                                    <h4 class="m-t-5" >12 Months</h4>

                                    <p>$29.99 / year</p>

                                    <button type="button" class="btn btn-success btn-lg btn-block"  >
                                        Select
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
                processing: false,
                paid: false,

                selected_plan: null,
                selected_plan_name: null,
                errorMessage: null,

                payment_data: null,

                plans:  {
                            year:   {
                                       name: 'year',
                                       label: 'Yearly subscription',
                                       price: 2999
                                    },

                            month:  {
                                       name: 'month',
                                       label: 'Monthly subscription',
                                       price: 299
                                    }
                        }
            }

        },

        components: { Card },

        methods:    {

            selectPlan(plan)  {

                // Select plan

                if(plan == 'year' || plan == 'month')   {

                    this.selected_plan = this['plans'][plan]
                    this.selected_plan_name = plan
                }
            },

            pay () {

                if(this.selected_plan)  {

                    this.complete = false
                    this.processing = true

                    createToken().then(
                        
                        card => {

                                let payload = {token: card.token.id, plan: this.selected_plan.name}

                                axios.post('/subscription/choose', payload).then(

                                    data => {

                                        console.log(data)

                                        this.complete = true
                                        this.paid = true
                                        this.processing = false

                                        window.location.href = "/onboarding"
                                    }
                                )
                            }

                        )
                }
                else {

                    alert('Please select a plan')
                }
            },

            change(event) {
                    
                if(event)    {

                    this.complete = event.complete
                }
            }
        }
    }
</script>
<template>
   <div>

        <card class='stripe-card'
          :class='{ complete }'
          :stripe='stripeKey'
          :options='stripeOptions'
          @change='change($event)'
        />
                    
        <div id="card-errors" role="alert" v-text="errorMessage"></div>

    </div>
</template>

<script>

    import { Card, createToken } from 'vue-stripe-elements'

    export default {

        data()  {

            return {

                stripeKey: AppData.stripeKey,

                complete: false,
                
                errorMessage: '',

                stripeOptions: {

                    style: {
                        
                        base: {
                            color: '#4A90E2',
                            lineHeight: '18px',
                            fontFamily: '"Raleway", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                              color: '#aab7c4'
                            }
                        },
                        
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    }
                }
            }

        },

        components: { Card },

        methods:    {

            change(event) {
                
                this.errorMessage = event.error ? event.error.message : '';

                this.$emit('change', event);
            }
        }
    }
</script>

<style>
.StripeElement {
  background-color: white;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 2px 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
{!! view_render_event('bagisto.admin.sales.order.create.cart.summary.before') !!}

<v-cart-summary
    :cart="cart"
></v-cart-summary>

{!! view_render_event('bagisto.admin.sales.order.create.cart.summary.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-cart-summary-template"
    >
        <div
            class="box-shadow rounded bg-white dark:bg-gray-900"
            id="review-step-container"
        >
            <div class="flex items-center border-b p-4 dark:border-gray-800">
                <p class="text-base font-semibold text-gray-800 dark:text-white">
                    @lang('admin::app.sales.orders.create.cart.summary.title')
                </p>
            </div>

            <!-- Cart Totals -->
            <div class="grid w-full justify-end gap-2.5 border-b p-4 dark:border-gray-800">
                <div class="grid gap-4">
                    <!-- Sub Total -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.sub_total.before') !!}

                    <template v-if="displayTax.subtotal == 'including_tax'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else-if="displayTax.subtotal == 'both'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total-excl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total }}
                            </p>
                        </div>

                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total-incl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else>
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total }}
                            </p>
                        </div>
                    </template>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.sub_total.after') !!}

                    <!-- Taxes -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.before') !!}

                    <div
                        class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right"
                        v-for="(amount, index) in cart.tax_amounts"
                        v-if="parseFloat(cart.tax_total)"
                    >
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.create.cart.summary.tax') (@{{ index }})
                        </p>

                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @{{ amount }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.after') !!}


                    <!-- Taxes -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.before') !!}

                    <div
                        class="flex justify-between text-right"
                        v-if="! cart.tax_total"
                    >
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('shop::app.checkout.cart.summary.tax')
                        </p>

                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @{{ cart.formatted_tax_total }}
                        </p>
                    </div>

                    <div
                        class="flex flex-col gap-2 border-y py-2"
                        v-else
                    >
                        <div
                            class="flex cursor-pointer justify-between text-right dark:text-white"
                            @click="cart.show_taxes = ! cart.show_taxes"
                        >
                            <p class="text font-semibold dark:text-white">
                                @lang('shop::app.checkout.cart.summary.tax')
                            </p>

                            <p class="flex items-center gap-1 text-base font-medium max-md:font-medium dark:text-white">
                                @{{ cart.formatted_tax_total }}
                            </p>
                        </div>

                        <div
                            class="flex flex-col gap-1 dark:text-white"
                            v-show="cart.show_taxes"
                        >
                            <div
                                class="flex justify-between gap-1 text-right"
                                v-for="(amount, index) in cart.applied_taxes"
                            >
                                <p class="text-sm max-md:text-sm max-md:font-normal">
                                    @{{ index }}
                                </p>

                                <p class="text-sm font-medium max-md:text-sm max-md:font-medium">
                                    @{{ amount }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.after') !!}

                    <!-- Discount -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.discount_amount.before') !!}

                    <div
                        class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right"
                        v-if="parseFloat(cart.discount_amount)"
                    >
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.create.cart.summary.discount-amount')
                        </p>

                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @{{ cart.formatted_discount_amount }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.discount_amount.after') !!}

                    <!-- Cart Grand Total -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.grand_total.before') !!}

                    <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                        <p class="text-lg font-semibold dark:text-white">
                            @lang('admin::app.sales.orders.create.cart.summary.grand-total')
                        </p>

                        <p class="text-lg font-semibold dark:text-white">
                            @{{ cart.formatted_grand_total }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.grand_total.after') !!}
                </div>
            </div>

            <div class="flex w-full justify-end p-4">
                <x-admin::button
                    type="button"
                    class="primary-button w-max px-11 py-3"
                    :title="trans('shop::app.checkout.onepage.summary.place-order')"
                    ::disabled="isPlacingOrder"
                    ::loading="isPlacingOrder"
                    @click="placeOrder"
                />
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-cart-summary', {
            template: '#v-cart-summary-template',

            props: ['cart'],

            data() {
                return {
                    displayTax: {
                        prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",

                        subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                    },

                    isLoading: false,

                    isPlacingOrder: false,
                }
            },

            methods: {
                placeOrder() {
                    this.isPlacingOrder = true;

                    this.$axios.post('{{ route('admin.sales.orders.store2', $cart->id) }}')
                        .then(response => {
                            if (response.data.data.redirect) {
                                window.location.href = response.data.data.redirect_url;
                            } else {
                                window.location.href = '{{ route('shop.checkout.onepage.success') }}';
                            }

                            this.isPlacingOrder = false;
                        })
                        .catch(error => {
                            this.isPlacingOrder = false

                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                        });
                }
            }
        });
    </script>
@endPushOnce

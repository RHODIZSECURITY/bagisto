<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.create.add-address')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses.create" />
        @endSection
    @endif

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <div class="mb-8 flex items-center max-md:mb-5">
            <!-- Back Button -->
            <a
                class="grid md:hidden"
                href="{{ route('shop.customers.account.addresses.index') }}"
            >
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
            </a>

            <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                @lang('shop::app.customers.account.addresses.create.add-address')
            </h2>
        </div>

        <v-create-customer-address>
            <!--Address Shimmer-->
            <x-shop::shimmer.form.control-group :count="10" />
        </v-create-customer-address>

    </div>

    @push('scripts')
        <script
            type="text/x-template"
            id="v-create-customer-address-template"
        >
            <div>
                <x-shop::form :action="route('shop.customers.account.addresses.store')" id="submit_adress_form">
                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.before') !!}

                    <!-- First Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.first-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="first_name"
                            name="first_name"
                            rules="required"
                            :value="old('first_name')"
                            :label="trans('shop::app.customers.account.addresses.create.first-name')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.first-name')"
                        />

                        <x-shop::form.control-group.error control-name="first_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.first_name.after') !!}

                    <!-- Last Name  -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.last-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="last_name"
                            name="last_name"
                            rules="required"
                            :value="old('last_name')"
                            :label="trans('shop::app.customers.account.addresses.create.last-name')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.last-name')"
                        />

                        <x-shop::form.control-group.error control-name="last_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.last_name.after') !!}

                    <!--Company Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.account.addresses.create.company-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="company_name"
                            :value="old('company_name')"
                            :label="trans('shop::app.customers.account.addresses.create.company-name')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.company-name')"
                        />

                        <x-shop::form.control-group.error control-name="company_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.company_name.after') !!}

                    <!-- E-mail -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="email"
                            name="email"
                            rules="required|email"
                            :value="old('email')"
                            :label="trans('shop::app.customers.account.addresses.create.email')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.email')"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.email.after') !!}

                    <!-- Vat Id -->
                    <x-shop::form.control-group>
                    
                        <x-shop::form.control-group.control
                            type="hidden"
                            name="vat_id"
                            :value="old('vat_id')"
                            :label="trans('shop::app.customers.account.addresses.create.vat-id')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.vat-id')"
                        />

                        <x-shop::form.control-group.error control-name="vat_id" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.vat_id.after') !!}

                    <!-- Street Address -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.street-address')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="address"
                            name="address[]"
                            rules="required|address"
                            :value="collect(old('address'))->first()"
                            :label="trans('shop::app.customers.account.addresses.create.street-address')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.street-address')"
                        />

                        <x-shop::form.control-group.error control-name="address[]" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.street_address.after') !!}

                    @if (
                        core()->getConfigData('customer.address.information.street_lines')
                        && core()->getConfigData('customer.address.information.street_lines') > 1
                    )
                        @for ($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++)
                            <x-shop::form.control-group.control
                                type="text"
                                name="address[{{ $i }}]"
                                :value="old('address[{{ $i }}]')"
                                rules="address"
                                :label="trans('shop::app.customers.account.addresses.create.street-address')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.street-address')"
                            />

                            <x-shop::form.control-group.error
                                class="mb-2"
                                name="address[{{ $i }}]"
                            />
                        @endfor
                    @endif

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.street_address.after') !!}

                    <!-- Country List-->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }}">
                            @lang('shop::app.customers.account.addresses.create.country')
                        </x-shop::form.control-group.label>
            
                        <x-shop::form.control-group.control
                            type="select"
                            id="country"
                            name="country"
                            rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
                            v-model="country"
                            aria-label="trans('shop::app.customers.account.addresses.create.country')"
                            :label="trans('shop::app.customers.account.addresses.create.country')"
                        >
                            <option value="">
                                @lang('shop::app.customers.account.addresses.create.select-country')
                            </option>
            
                            @foreach (core()->countries() as $country)
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach
                        </x-shop::form.control-group.control>
            
                        <x-shop::form.control-group.error control-name="country" />
                    </x-shop::form.control-group>
        
                    <!-- State Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }}">
                            @lang('shop::app.customers.account.addresses.create.state')
                        </x-shop::form.control-group.label>
        
                        <template v-if="haveStates()">
                            <x-shop::form.control-group.control
                                type="select"
                                id="state"
                                name="state"
                                rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                v-model="state"
                                :label="trans('shop::app.customers.account.addresses.create.state')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.state')"
                            >
                                <option 
                                    v-for='(state, index) in countryStates[country]'
                                    :value="state.code"
                                >
                                    @{{ state.default_name }}
                                </option>
                            </x-shop::form.control-group.control>
                        </template>
        
                        <template v-else>
                            <x-shop::form.control-group.control
                                type="text"
                                id="state"
                                name="state"
                                :value="old('state')"
                                rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                :label="trans('shop::app.customers.account.addresses.create.state')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.state')"
                            />
                        </template>
        
                        <x-shop::form.control-group.error control-name="state" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.state.after') !!}

                    <!-- City -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.city')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="city"
                            name="city"
                            rules="required"
                            :value="old('city')"
                            :label="trans('shop::app.customers.account.addresses.create.city')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.city')"
                        />

                        <x-shop::form.control-group.error control-name="city" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.city.after') !!}

                    <!-- Post Code -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="{{ core()->isPostCodeRequired() ? 'required' : '' }}">
                            @lang('shop::app.customers.account.addresses.create.post-code')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="postcode"
                            name="postcode"
                            rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}|numeric"
                            :value="old('postcode')"
                            :label="trans('shop::app.customers.account.addresses.create.post-code')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.post-code')"
                        />

                        <x-shop::form.control-group.error control-name="postcode" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.postcode.after') !!}

                    <!-- Contact -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.addresses.create.phone')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            id="phone"
                            name="phone"
                            rules="required|phone"
                            :value="old('phone')"
                            :label="trans('shop::app.customers.account.addresses.create.phone')"
                            :placeholder="trans('shop::app.customers.account.addresses.create.phone')"
                        />

                        <x-shop::form.control-group.error control-name="phone" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.phone.after') !!}

                    <!-- Set As Default -->
                    <div class="text-md mb-4 flex select-none items-center gap-x-1.5 text-zinc-500">
                        <input
                            type="checkbox"
                            name="default_address"
                            value="1"
                            id="default_address"
                            class="peer hidden cursor-pointer"
                        >

                        <label
                            class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue"
                            for="default_address"
                        >
                        </label>

                        <label 
                            class="block cursor-pointer text-base max-md:text-sm"
                            for="default_address"
                        >
                            @lang('shop::app.customers.account.addresses.create.set-as-default')
                        </label>
                    </div>

                    <button
                        type="submit" id="submit_address_btn"
                        class="primary-button m-0 block rounded-2xl px-11 py-3 text-center text-base max-md:w-full max-md:max-w-full max-md:rounded-lg max-md:py-2 max-sm:py-1.5"
                    >
                        @lang('shop::app.customers.account.addresses.create.save')
                    </button>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.after') !!}
                </x-shop::form>
                {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}
            </div>
        </script>
    
        <script type="module">
            app.component('v-create-customer-address', {
                template: '#v-create-customer-address-template',

                mounted() {
                    this.listenAddressEvents();
                },

                data() {
                    return {
                        country: "{{ old('country') }}",

                        state: "{{ old('state') }}",

                        countryStates: @json(core()->groupedStatesByCountries()),
                    }
                },
    
                methods: {
                    haveStates() {
                        /*
                        * The double negation operator is used to convert the value to a boolean.
                        * It ensures that the final result is a boolean value,
                        * true if the array has a length greater than 0, and otherwise false.
                        */
                        return !!this.countryStates[this.country]?.length;
                    },

                    listenAddressEvents() {

                        let myAxios = this.$axios;
                        let myEmiter = this.$emitter;
                        let submitBtn = document.getElementById('submit_address_btn');

                        submitBtn.addEventListener('click', function(event) {

                            try {

                                event.preventDefault();

                                submitBtn.disabled = true;

                                const formulario = document.getElementById('submit_adress_form');
                                const formData = new FormData(formulario);

                                function isInvalid(value) {
                                    if (Array.isArray(value)) {
                                        return value.length === 0 || value.some(v => v.trim() === '');
                                    }
                                    return !value || value.trim().length === 0;
                                }

                                // Crear el JSON en el formato requerido
                                const params = {
                                    address: formData.getAll('address[]'), // La dirección como un array con un solo elemento
                                    city: formData.get('city'),
                                    postcode: formData.get('postcode'),
                                    state: formData.get('state'),

                                    first_name: formData.get('first_name'),
                                    last_name: formData.get('last_name'),
                                    country: formData.get('country'),
                                    email: formData.get('email'),
                                    phone: formData.get('phone')
                                };

                                // Validar cada campo en 'params'
                                const hasEmptyField = Object.keys(params).some(key => isInvalid(params[key]));

                                if (hasEmptyField) {
                                    formulario.submit();
                                }

                                console.log(params);
                                //console.this.$axios);

                                //Pedir la validacion primero
                                myAxios.post('{{ route('rhodiz.usps.addresses.validate') }}', params)
                                    .then(response => {

                                        let address = response.data.data.address;
                                        let city = response.data.data.city;
                                        let postcode = response.data.data.postcode;
                                        let state = response.data.data.state;

                                        //Si los parametros son identicos no muestro nada al cliente
                                        if (params['address']==address && params['city']==city &&
                                            params['postcode']==postcode && params['state']==state) {
                                            //submitBtn.disabled = false;
                                            formulario.submit();
                                            return;
                                        }

                                        //Se recibe una correccion
                                        let direccionSugerida = `[${address}, ${state}, ${city}, ${postcode}]`;

                                        this.$emitter.emit('open-confirm-modal', {
                                            title: 'Aseguremonos de que su direccion sea correcta',
                                            message: `Direccion sugerida: ${direccionSugerida}. Seleccione USAR SUGERENCIA si la sugerencia es correcta. Seleccione GUARDAR ASI para guardar la direccion que usted ingreso`,
                                            options: {
                                                btnDisagree: "Guardar asi",
                                                btnAgree: "Usar Sugerencia"
                                            },
                                            agree: () => {

                                                console.log("cambios sugeridos -guardar CON cambios- agree");

                                                //Corregir la direccion
                                                // Establece valores para los controles de texto específicos usando su id
                                                document.getElementById('address').value = address;
                                                document.getElementById('city').value = city;
                                                document.getElementById('postcode').value = postcode;
                                                document.getElementById('state').value = state;

                                                submitBtn.disabled = false;

                                                formulario.submit();
                                            },
                                            disagree: () => {

                                                submitBtn.disabled = false;

                                                console.log("cambios sugeridos -guardar sin cambios- disagree");

                                                formulario.submit();
                                            }
                                        });

                                    })
                                    .catch(error => {

                                        console.log("direccion no valida");

                                        //No es valida la direccion
                                        myEmiter.emit('open-confirm-modal', {
                                            title: 'No podemos confirmar su direccion',
                                            message: 'Compruebe que su direccion sea correcta y seleccione EDITAR si necesita modificar su direccion. Si la direccion que usted entro es correcta entonces seleccione GUARDAR ASI',
                                            options: {
                                                btnDisagree: "Guardar asi",
                                                btnAgree: "Editar"
                                            },
                                            agree: () => {
                                                //Seguir editando
                                                submitBtn.disabled = false;
                                                console.log("direccion no valida -seguir editando- DISAGREEE");
                                            },
                                            disagree: () => {
                                                submitBtn.disabled = false;
                                                console.log("direccion no valida -guardar cambios- AGREEE");
                                                formulario.submit();
                                            }
                                        });

                                        //return Promise.reject(error);
                                    });

                            } catch (error) {
                                console.error('Error de red:', error);
                                submitBtn.disabled = false;
                                //Si hay errores entonces envio el formulario
                                formulario.submit();
                            }
                        });
                    },
                }
            });
        </script>
    @endpush

</x-shop::layouts.account>

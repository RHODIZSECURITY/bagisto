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

                    <div class="mt-4 flex justify-begin">
                        <x-shop::button
                            type="submit"  id="submit_address_btn"
                            class="primary-button rounded-2xl px-11 py-3 max-md:rounded-lg max-sm:w-full max-sm:max-w-full max-sm:py-1.5"
                            :title="trans('shop::app.customers.account.addresses.create.save')"
                            ::loading="isStoring"
                            ::disabled="isStoring"
                            @click="handleFormSubmit"
                        />
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.after') !!}

                </x-shop::form>
                {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}
            </div>
        </script>

        <script type="module">
            app.component('v-create-customer-address', {
                template: '#v-create-customer-address-template',

                data() {
                    return {
                        country: "{{ old('country') }}",

                        state: "{{ old('state') }}",

                        countryStates: @json(core()->groupedStatesByCountries()),

                        isStoring: false,
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

                    handleFormSubmit() {

                        let myAxios = this.$axios;
                        let myEmiter = this.$emitter;
                        let submitBtn = document.getElementById('submit_address_btn');
                        let printAdresses =  this.printAdresses;
                        let setIsStoring = this.setIsStoring;

                        try {

                            event.preventDefault();

                            setIsStoring(true);

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

                            const direccionEntrada = `${params.address}, ${params.state}, ${params.city}, ${params.postcode}`;

                            // Validar cada campo en 'params'
                            const hasEmptyField = Object.keys(params).some(key => isInvalid(params[key]));

                            if (hasEmptyField) {
                                formulario.submit();
                                return;
                            }

                            //Pedir la validacion primero
                            myAxios.post('{{ route('rhodiz.usps.addresses.validate') }}', params)
                                .then(response => {

                                    setIsStoring(false);

                                    let address = response.data.data.address;
                                    let city = response.data.data.city;
                                    let postcode = response.data.data.postcode;
                                    let state = response.data.data.state;

                                    //Si los parametros son identicos no muestro nada al cliente
                                    if (params['address']==address && params['city']==city &&
                                        params['postcode']==postcode && params['state']==state) {
                                        formulario.submit();
                                        return;
                                    }

                                    //Se recibe una correccion
                                    let direccionSugerida = `${address}, ${state}, ${city}, ${postcode}`;

                                    this.$emitter.emit('open-confirm-modal', {
                                        title: "{{ __('usps_flat::app.shop.address.modal_suggestion.title') }}",
                                        message: "{{ __('usps_flat::app.shop.address.modal_suggestion.description') }}",
                                        options: {
                                            btnDisagree: "{{ __('usps_flat::app.shop.address.modal_suggestion.button-save') }}",
                                            btnAgree: "{{ __('usps_flat::app.shop.address.modal_suggestion.button-accept') }}"
                                        },
                                        agree: () => {

                                            console.log("cambios sugeridos -guardar CON cambios- agree");

                                            //Corregir la direccion
                                            // Establece valores para los controles de texto específicos usando su id
                                            document.getElementById('address').value = address;
                                            document.getElementById('city').value = city;
                                            document.getElementById('postcode').value = postcode;
                                            document.getElementById('state').value = state;

                                            formulario.submit();
                                        },
                                        disagree: () => {

                                            console.log("cambios sugeridos -guardar sin cambios- disagree");

                                            formulario.submit();
                                        }
                                    });

                                    printAdresses(direccionEntrada, direccionSugerida);
                                })
                                .catch(error => {
                                    //console.log(error);
                                    //console.log("direccion no valida");
                                    setIsStoring(false);

                                    //No es valida la direccion
                                    myEmiter.emit('open-confirm-modal', {
                                        title: "{{ __('usps_flat::app.shop.address.modal_invalid.title') }}",
                                        message: "{{ __('usps_flat::app.shop.address.modal_invalid.description') }}",
                                        options: {
                                            btnDisagree: "{{ __('usps_flat::app.shop.address.modal_invalid.button-save') }}",
                                            btnAgree: "{{ __('usps_flat::app.shop.address.modal_invalid.button-accept') }}"
                                        },
                                        agree: () => {
                                            //Seguir editando
                                            console.log("direccion no valida -seguir editando- DISAGREEE");
                                        },
                                        disagree: () => {
                                            console.log("direccion no valida -guardar cambios- AGREEE");
                                            formulario.submit();
                                        }
                                    });

                                    //return Promise.reject(error);
                                });

                        } catch (error) {
                            setIsStoring(false);
                            console.error('Error de red:', error);

                            //Si hay errores entonces envio el formulario
                            formulario.submit();
                        }

                    },
                    printAdresses(direccionEntrada, direccionSugerida) {

                        // Obtenemos el elemento donde se mostrará el mensaje
                        const modalConfirmMsg = document.getElementById('modal_confirm_msg');

                        direccionEntrada = direccionEntrada.toUpperCase();

                        // Dividimos las direcciones por comas y eliminamos espacios extra
                        const partesEntrada = direccionEntrada.split(',').map(part => part.trim());
                        const partesSugerida = direccionSugerida.split(',').map(part => part.trim());

                        // Creamos el contenido HTML con estilo inline
                        let contenidoEntrada = '';
                        let contenidoSugerida = '';

                        for (let i = 0; i < partesEntrada.length; i++) {
                            // Comparamos cada parte y resaltamos las diferencias
                            if (partesEntrada[i] === partesSugerida[i]) {
                                contenidoEntrada += `<span>${partesEntrada[i]}</span>, `;
                                contenidoSugerida += `<span>${partesSugerida[i]}</span>, `;
                            } else {
                                contenidoEntrada += `<span style="color: red; font-weight: bold;">${partesEntrada[i]}</span>, `;
                                contenidoSugerida += `<span style="color: green; font-weight: bold;">${partesSugerida[i]}</span>, `;
                            }
                        }

                        // Eliminamos la última coma y espacio
                        contenidoEntrada = contenidoEntrada.slice(0, -2);
                        contenidoSugerida = contenidoSugerida.slice(0, -2);

                        const dirEntradaMsg = "{{ __('usps_flat::app.shop.address.modal_suggestion.address-entered') }}";
                        const dirSugeridaMsg = "{{ __('usps_flat::app.shop.address.modal_suggestion.address-suggested') }}";

                        // Insertamos el contenido HTML en el div
                        modalConfirmMsg.innerHTML = `<br>
                        <div style="padding: 0px; font-family: Arial, sans-serif; color: #333;">
                            <div style="margin-bottom: 8px;">
                            <span style="font-weight: bold; color: black;">${dirEntradaMsg}:</span>
                            <div style="background-color: #fffbea; padding: 8px; border-radius: 4px;">
                                ${contenidoEntrada}
                            </div>
                            </div>
                            <div>
                            <span style="font-weight: bold; color: black;">${dirSugeridaMsg}:</span>
                            <div style="background-color: #e6ffed; padding: 8px; border-radius: 4px;">
                                ${contenidoSugerida}
                            </div>
                            </div>
                        </div>
                        `;
                    },
                    setIsStoring(value) {
                        this.isStoring = value;
                    }
                }
            });
        </script>
    @endpush

</x-shop::layouts.account>

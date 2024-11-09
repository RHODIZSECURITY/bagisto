@extends('rhodiz_config::emails.layout')

@section('content')
    <div style="max-width: 600px; margin: 2rem auto; font-family: Arial, sans-serif;">
        <!-- Selector de idioma -->
        <form method="GET" action="{{ route('rhodiz.config.mail_index') }}" style="text-align: center; margin-bottom: 1rem;">
            <label for="language" style="font-weight: bold;">Selecciona el idioma:</label>
            <select name="lang" id="language" onchange="this.form.submit()" style="padding: 0.3rem; font-size: 1rem; margin-left: 0.5rem;">

                <option value="es" {{ request('lang') == 'es' ? 'selected' : '' }}>Español</option>
                <option value="en" {{ request('lang') == 'en' ? 'selected' : '' }}>Inglés</option>
            </select>
        </form>

        <div style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div style="background-color: #007bff; color: #fff; padding: 1rem; border-top-left-radius: 8px; border-top-right-radius: 8px; text-align: center;">
                <h2 style="margin: 0; font-size: 1.5rem;">Listado de Preview de Correos</h2>
            </div>
            <div style="padding: 1rem;">
                <ul style="list-style-type: none; padding: 0; margin: 0;">
                    @foreach($emails as $email)
                        <li style="border-bottom: 1px solid #ddd; padding: 0.5rem 0; display: flex; justify-content: space-between; align-items: center;">
                            <span>{{ $email }}</span>
                            <a href="{{ route('rhodiz.config.mail_preview', ['type' => $email, 'lang' => request('lang')]) }}" style="color: #007bff; text-decoration: none; padding: 0.3rem 0.6rem; border: 1px solid #007bff; border-radius: 4px; font-size: 0.9rem;">
                                Ver Preview
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection


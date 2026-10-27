<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NATURAGO | Ecoturismo sostenible</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <!-- ================= HEADER ================= -->

    <header class="header">

        <div class="logo">
            🌿 NATURAGO
        </div>

        <nav class="navegacion">

            <a href="#inicio">Inicio</a>

            <a href="#experiencias">Experiencias</a>

            <a href="#nosotros">Nosotros</a>

            <button
                id="botonLogin"
                class="btn-login"
                type="button">

                Iniciar sesión

            </button>

            <button
                id="botonRegistro"
                class="btn-registro"
                type="button">

                Registrarse

            </button>

        </nav>

    </header>


    <!-- ================= HERO ================= -->

    <section id="inicio" class="hero">

        <div class="hero-contenido">

            <span class="etiqueta">
                ECOTURISMO SOSTENIBLE
            </span>

            <h1>
                Descubre Colombia de una forma diferente
            </h1>

            <p>
                Vive experiencias únicas, conecta con la naturaleza
                y descubre destinos increíbles de Colombia de una
                manera responsable y sostenible.
            </p>

            <a
                href="#experiencias"
                class="btn-principal">

                Explorar experiencias

            </a>

        </div>

    </section>


    <!-- ================= EXPERIENCIAS ================= -->

    <main
        id="experiencias"
        class="experiencias">

        <h2>
            Experiencias sostenibles
        </h2>

        <p class="subtitulo">

            Conoce algunas experiencias de ecoturismo que puedes
            disfrutar en diferentes lugares de Colombia.

        </p>


        <section class="cards">


            <!-- CARD 1 -->

            <article class="card">

                <img
                    src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=800&q=80"
                    alt="Senderismo">

                <div class="card-contenido">

                    <span class="categoria">
                        🌿 Ecoturismo
                    </span>

                    <h3>
                        Senderismo en la Sierra Nevada
                    </h3>

                    <p>
                        📍 Santa Marta, Magdalena
                    </p>

                    <p>
                        Recorre senderos naturales rodeados
                        de montañas y biodiversidad.
                    </p>

                    <strong>
                        $120.000 COP
                    </strong>

                    <button
                        class="btn-card"
                        type="button">

                        Ver experiencia

                    </button>

                </div>

            </article>


            <!-- CARD 2 -->

            <article class="card">

                <img
                    src="https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=800&q=80"
                    alt="Avistamiento de aves">

                <div class="card-contenido">

                    <span class="categoria">
                        🌿 Ecoturismo
                    </span>

                    <h3>
                        Avistamiento de aves
                    </h3>

                    <p>
                        📍 Leticia, Amazonas
                    </p>

                    <p>
                        Conoce diferentes especies de aves
                        mientras disfrutas del Amazonas.
                    </p>

                    <strong>
                        $150.000 COP
                    </strong>

                    <button
                        class="btn-card"
                        type="button">

                        Ver experiencia

                    </button>

                </div>

            </article>


            <!-- CARD 3 -->

            <article class="card">

                <img
                    src="https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=800&q=80"
                    alt="Ecocamping">

                <div class="card-contenido">

                    <span class="categoria">
                        🌿 Ecoturismo
                    </span>

                    <h3>
                        Ecocamping bajo las estrellas
                    </h3>

                    <p>
                        📍 Guatapé, Antioquia
                    </p>

                    <p>
                        Descansa y conecta con la naturaleza
                        en un entorno sostenible.
                    </p>

                    <strong>
                        $180.000 COP
                    </strong>

                    <button
                        class="btn-card"
                        type="button">

                        Ver experiencia

                    </button>

                </div>

            </article>

        </section>

    </main>


    <!-- ================= NOSOTROS ================= -->

    <section
        id="nosotros"
        class="nosotros">

        <h2>
            🌱 Sobre NATURAGO
        </h2>

        <p>
            NATURAGO es una plataforma enfocada
            en conectar viajeros con experiencias
            de ecoturismo sostenible.
        </p>

        <p>
            Nuestro objetivo es promover el turismo
            responsable, apoyar comunidades locales
            y proteger la naturaleza.
        </p>

    </section>


    <!-- ================= FOOTER ================= -->

    <footer class="footer">

        <p>
            🌿 NATURAGO
        </p>

        <p>
            Descubre. Explora. Conserva.
        </p>

    </footer>


    <!-- ================= MODAL LOGIN ================= -->

    <div
        id="modalLogin"
        class="modal">

        <div class="modal-contenido">

            <button
                id="cerrarLogin"
                class="cerrar"
                type="button">

                ×

            </button>

            <h2>
                🌿 Iniciar sesión
            </h2>

            <p>
                Ingresa tus datos para continuar.
            </p>


            <form id="formLogin">

                <label>
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="loginCorreo"
                    required>


                <label>
                    Contraseña
                </label>

                <input
                    type="password"
                    id="loginPassword"
                    required>


                <button
                    type="submit"
                    class="boton-formulario">

                    Iniciar sesión

                </button>

            </form>

            <p id="mensajeLogin"></p>

        </div>

    </div>


    <!-- ================= MODAL REGISTRO ================= -->

    <div
        id="modalRegistro"
        class="modal">

        <div class="modal-contenido">

            <button
                id="cerrarRegistro"
                class="cerrar"
                type="button">

                ×

            </button>

            <h2>
                🌱 Crear una cuenta
            </h2>

            <p>
                Regístrate en NATURAGO.
            </p>


            <form id="formRegistro">

                <label>
                    Nombre
                </label>

                <input
                    type="text"
                    id="registroNombre"
                    required>


                <label>
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="registroCorreo"
                    required>


                <label>
                    Contraseña
                </label>

                <input
                    type="password"
                    id="registroPassword"
                    required>


                <button
                    type="submit"
                    class="boton-formulario">

                    Crear cuenta

                </button>

            </form>

            <p id="mensajeRegistro"></p>

        </div>

    </div>


    <!-- JAVASCRIPT -->

    
<!-- ASISTENTE TURÍSTICO NATURAGO -->

<button
    id="abrirAsistente"
    class="asistente-boton"
    type="button"
    aria-label="Abrir asistente turístico"
    aria-controls="ventanaAsistente"
    aria-expanded="false">
    💬
</button>

<section
    id="ventanaAsistente"
    class="asistente-ventana"
    aria-label="Asistente turístico NATURAGO"
    hidden>

    <header class="asistente-cabecera">
        <div>
            <strong>🌿 Asistente NATURAGO</strong>
            <p>Tu guía de ecoturismo</p>
        </div>

        <button
            id="cerrarAsistente"
            class="asistente-cerrar"
            type="button"
            aria-label="Cerrar asistente">
            ×
        </button>
    </header>

    <div
        id="mensajesAsistente"
        class="asistente-mensajes"
        aria-live="polite"
        aria-relevant="additions">

        <p class="mensaje-chat mensaje-bot">
            ¡Hola! 🌱 Puedo ayudarte a conocer nuestras experiencias
            de ecoturismo, ubicaciones y precios. ¿Qué te gustaría explorar?
        </p>

    </div>

    <form id="formAsistente" class="asistente-formulario">
        <label class="sr-solo" for="preguntaAsistente">
            Escribe tu pregunta
        </label>

        <input
            id="preguntaAsistente"
            type="text"
            maxlength="500"
            placeholder="Ej. ¿Cuánto cuesta el senderismo?"
            autocomplete="off"
            required>

        <button id="enviarAsistente" type="submit">
            Enviar
        </button>
    </form>

    <p class="asistente-nota">
        Información orientativa. Consulta las condiciones antes de reservar.
    </p>

</section>

<!-- TUS SCRIPTS -->
<script src="script.js"></script>
<script src="asistente.js"></script>

</body>
</html>

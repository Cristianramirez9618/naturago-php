
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, Field

app = FastAPI(
    title="NATURAGO - Asistente Turístico",
    description="API para orientar a los viajeros sobre ecoturismo en Colombia",
    version="1.0.0"
)

# Permite que el frontend local se comunique con Python.
# No uses "*" en producción; configura allí el dominio autorizado.
app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "http://localhost",
        "http://127.0.0.1",
        "http://localhost:80",
        "http://127.0.0.1:80",
    ],
    allow_credentials=False,
    allow_methods=["GET", "POST"],
    allow_headers=["Content-Type"],
)


class Pregunta(BaseModel):
    mensaje: str = Field(min_length=1, max_length=500)


EXPERIENCIAS = {
    "senderismo": {
        "nombre": "Senderismo en la Sierra Nevada",
        "ubicacion": "Santa Marta, Magdalena",
        "precio": "$120.000 COP",
        "descripcion": (
            "Recorre senderos naturales rodeados de montañas "
            "y biodiversidad."
        ),
    },
    "aves": {
        "nombre": "Avistamiento de aves",
        "ubicacion": "Leticia, Amazonas",
        "precio": "$150.000 COP",
        "descripcion": (
            "Observa aves y disfruta de la biodiversidad "
            "de la región amazónica."
        ),
    },
    "camping": {
        "nombre": "Ecocamping bajo las estrellas",
        "ubicacion": "Guatapé, Antioquia",
        "precio": "$180.000 COP",
        "descripcion": (
            "Descansa y conecta con la naturaleza "
            "en un entorno sostenible."
        ),
    },
}


def responder(mensaje: str) -> str:
    texto = mensaje.lower().strip()

    # Consultar precios
    if any(p in texto for p in ["precio", "precios", "cuesta", "valor", "vale"]):
        return (
            "Estos son los precios de referencia de NATURAGO:\n\n"
            "• Senderismo en la Sierra Nevada: $120.000 COP.\n"
            "• Avistamiento de aves en Leticia: $150.000 COP.\n"
            "• Ecocamping en Guatapé: $180.000 COP.\n\n"
            "Son los valores publicados en la página de ejemplo. "
            "Confirma disponibilidad y condiciones antes de reservar."
        )

    # Consultar el Amazonas o el avistamiento de aves
    if any(p in texto for p in ["amazonas", "leticia", "aves", "pájaros"]):
        e = EXPERIENCIAS["aves"]
        return (
            f"Te recomiendo {e['nombre']}.\n"
            f"Ubicación: {e['ubicacion']}.\n"
            f"Precio de referencia: {e['precio']}.\n"
            f"{e['descripcion']}"
        )

    # Consultar senderismo o Sierra Nevada
    if any(p in texto for p in ["senderismo", "sierra nevada", "montaña", "montañas"]):
        e = EXPERIENCIAS["senderismo"]
        return (
            f"Te recomiendo {e['nombre']}.\n"
            f"Ubicación: {e['ubicacion']}.\n"
            f"Precio de referencia: {e['precio']}.\n"
            f"{e['descripcion']}"
        )

    # Consultar camping o Guatapé
    if any(p in texto for p in ["camping", "acampar", "estrellas", "guatapé", "guatape"]):
        e = EXPERIENCIAS["camping"]
        return (
            f"Te recomiendo {e['nombre']}.\n"
            f"Ubicación: {e['ubicacion']}.\n"
            f"Precio de referencia: {e['precio']}.\n"
            f"{e['descripcion']}"
        )

    # Consultar experiencias generales
    if any(p in texto for p in ["experiencias", "actividades", "opciones", "recomienda", "recomendar"]):
        return (
            "¡Claro! Estas son las experiencias disponibles en NATURAGO:\n\n"
            "1. Senderismo en la Sierra Nevada, Santa Marta: $120.000 COP.\n"
            "2. Avistamiento de aves, Leticia: $150.000 COP.\n"
            "3. Ecocamping bajo las estrellas, Guatapé: $180.000 COP.\n\n"
            "Puedes preguntarme por una experiencia o por sus precios."
        )

    # Saludos
    if any(p in texto for p in ["hola", "buenos días", "buenas tardes", "buenas noches"]):
        return (
            "¡Hola! 🌿 Soy el asistente turístico de NATURAGO. "
            "Puedo orientarte sobre experiencias de ecoturismo en Colombia, "
            "ubicaciones y precios de referencia. ¿Qué te gustaría conocer?"
        )

    return (
        "Puedo ayudarte a conocer las experiencias de NATURAGO: "
        "senderismo en la Sierra Nevada, avistamiento de aves en el Amazonas "
        "y ecocamping en Guatapé. También puedo informarte sobre sus precios. "
        "¿Cuál te interesa?"
    )


@app.get("/")
def inicio():
    return {
        "success": True,
        "mensaje": "API del asistente turístico NATURAGO activa."
    }


@app.post("/chat")
def chat(pregunta: Pregunta):
    mensaje = pregunta.mensaje.strip()

    if not mensaje:
        return {
            "success": False,
            "respuesta": "Escribe una pregunta para continuar."
        }

    return {
        "success": True,
        "respuesta": responder(mensaje)
    }

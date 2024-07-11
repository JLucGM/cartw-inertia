<script setup>
import { usePage } from '@inertiajs/vue3';
import { Head, Link, router } from '@inertiajs/vue3';


const page = usePage();
const cart = page.props.cart;
const tax = page.props.tax;
const total = page.props.total;
const business = page.props.business.slug;
const phoneNumber = page.props.phone; // Replace with your phone number

//console.log(cart)

//console.log(route('shop', { slug: business }))
//console.log(tax);
console.log(page.props.cart);

const deleteItem = (rowId) => {
    router.delete(route('carrito.eliminar', { id: rowId }), {
        onSuccess: () => {
            router.visit(route('cart.index', { slug: business }), { method: 'GET' });
        }
    });
}

const sendWhatsApp = () => {
    const nameClient = document.getElementById('nameClient').value;
    const message = document.getElementById('message').value;
    const cart = page.props.cart;


    // Obtener el valor del radio button seleccionado
    // let radioButtonValue;
    // const radios = document.getElementsByName('flexRadioDefault');
    // for (let i = 0; i < radios.length; i++) {
    //     if (radios[i].checked) {
    //         radioButtonValue = radios[i].value;
    //         break;
    //     }
    // }

    console.log(cart);
let cartContents = '';
Object.keys(cart).forEach((key) => {
    const item = cart[key];
    cartContents += `* ${item.name} (x${item.qty}) - ${item.price} \n`;
    console.log(cartContents)
});

const apiURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(
        "*NOMBRE Y APELLIDO:* \n" + nameClient + "\n" +
        message +
        "\n *Subtotal:* " + tax +
        "\n *Total:* " + total + "\n" + "........................................................................" +
        "\n *Contenido del carrito:* \n" + cartContents + "\n" + "........................................................................" +
        "\n *Notas del pedido:* \n" + message + "\n" + "........................................................................" 
        // + "\n *Tipo de servicio:* \n" + radioButtonValue
    )}`;

window.open(apiURL, '_blank');
};

</script>

<template>
    <!-- ... -->
    <div class="cart-summary">
        <h2>Carrito</h2>
        <button @click.prevent="sendWhatsApp">Enviar por WhatsApp</button>
        <input id="nameClient" type="text" placeholder="Nombre y Apellido">
        <input id="message" type="text" placeholder="Notas del pedido">
        <ul>
            <li v-for="item in cart" :key="item.rowId">
                {{ item.name }} ({{ item.qty }})


                Precio unitario {{ item.price }}
                subtotal {{ item.subtotal }}
                total {{ item.total }}

                <button @click.prevent="deleteItem(item.rowId)">Eliminar</button>

            </li>
        </ul>
    </div>
    <!-- ... -->
</template>



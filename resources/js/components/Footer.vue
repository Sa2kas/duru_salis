<template>
    <div class="footer">
        <div class="footer-text">
            © {{currentDate}} | {{$i18n.locale == 'lt' ? 'Visos teisės saugomos' : 'All rights reserved'}}
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
        }
    },
    computed: {
        currentDate () {
            return new Date().getFullYear()
        }
    }
}
</script>
<style>
    .footer {
        border-top: 1px solid rgba(114, 59, 27, 0.5);
        background-color: #fff;
        height: 40px;
        color: #723B1B;
        text-align: center;
        width: 100%;
    }
    .footer-text {
        padding: 1em;
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
        font-size: 12px;
        letter-spacing: -0.02em;
    }
</style>
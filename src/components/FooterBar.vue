<template>
    <footer class="footer">
        <div class="container text-center py-4">
            <p class="mb-0">&copy; 2025 SocialPlatform. Все права защищены.</p>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'FooterBar'
}
</script>

<style scoped>
.footer {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    color: #ffffff;
    border-top: 1px solid rgba(255, 107, 53, 0.2);
    margin-top: auto;
}

.footer p {
    margin: 0;
    color: #a8a8c0;
}
</style>
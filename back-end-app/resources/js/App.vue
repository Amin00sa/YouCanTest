<script setup>
    import {RouterLink} from 'vue-router'
</script>

<template>
    <header>
        <div className="wrapper">
            <nav className="nav">
                <RouterLink to="/products" class="nav-link mx-2">products</RouterLink>
                <RouterLink to="/categories" class="nav-link mx-2">categories</RouterLink>
            </nav>
        </div>
    </header>
</template>

<style scoped>
    header {
    max-height: 100vh;
}

    @media (min-width: 1024px) {
    header {
    display: flex;
    place-items: center;
}

    header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
}
}
</style>

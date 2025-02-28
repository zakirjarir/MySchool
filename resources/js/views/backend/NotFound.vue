<template>
    <div class="body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 not-found-container">
                    <h1>404</h1>
                    <h3>Page Not Found</h3>
                    <p>Sorry, the page you are looking for could not be found.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NotFound",
}
</script>

<style scoped>
.body {
    background-color: #f8f9fa;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.not-found-container {
    text-align: center;
}
.not-found-container h1 {
    font-size: 100px;
    font-weight: bold;
    color: #dc3545;
}
.not-found-container p {
    font-size: 20px;
    color: #6c757d;
}
</style>

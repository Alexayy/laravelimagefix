<template>
    <div class="upload-images">
        <h1>Upload Images</h1>
        <input type="file" ref="fileInput" multiple @change="onFileChange" />
        <button @click="fixImages">Fix Images</button>

        <div class="images-container">
            <div v-for="(image, index) in images" :key="index" class="image-item">
                <h2>Image {{ index + 1 }}</h2>
                <div class="original-image">
                    <img :src="image" />
                </div>
                <div class="fixed-image" v-if="fixedImages[index]">
                    <h3>Fixed image</h3>
                    <img :src="fixedImages[index]" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'UploadImages',
    data() {
        return {
            images: [],
            fixedImages: []
        }
    },

    methods: {
        onFileChange(e) {
            this.images = [];
            this.fixedImages = [];

            const files = e.target.files;

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageUrl = e.target.result;
                    this.images.push(imageUrl);
                };
                reader.readAsDataURL(files[i]);
            }
        },

        fixImages() {
            const formData = new FormData();

            for (let i = 0; i < this.images.length; i++) {
                formData.append('images[]', this.images[i]);
            }

            axios.post('/fix-images', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    console.log(response);
                    this.fixedImages = response.data.fixedImages;
                })
                .catch(error => {
                    console.error(error);
                });
        }


        // async fixImages() {
        //     const formData = new FormData();
        //
        //     for (let i = 0; i < this.images.length; i++) {
        //         formData.append('images[]', this.images[i]);
        //     }
        //
        //     try {
        //         const response = await axios.post('/fix-images', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data'
        //             }
        //         });
        //
        //         console.log(response)
        //         this.fixedImages = response.data.fixedImages;
        //     } catch (error) {
        //         console.error(error);
        //     }
        // }

    },
}
</script>

<style scoped>
.upload-images {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

.images-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 30px;
    gap: 20px;
}

.image-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 300px;
    padding: 10px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

h2 {
    font-size: 24px;
    margin-top: 20px;
    margin-bottom: 10px;
}

h3 {
    font-size: 20px;
    margin-top: 10px;
    margin-bottom: 5px;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    background-color: #1e90ff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #005eff;
}

.original-image img {
    max-width: 100%;
    border-radius: 5px;
}

.fixed-image {
    margin-top: 20px;
    text-align: center;
}

.fixed-image img {
    max-width: 100%;
    border-radius: 5px;
}
</style>

<template>
    <div class="">
        <h1>Create test</h1>
        <form @submit.prevent="submit_form()">
            <div class="form-group">
                <label for="postTitleField">Post title</label>
                <input v-model="fields.title" id='postTitleField' type="text" class="form-control">
                <div class="alert alert-danger" v-if="errors && errors.title">
                    {{ errors.title[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="postTextField">Post title</label>
                <textarea v-model="fields.text" id='postTextField' type="text" class="form-control"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.text">
                    {{ errors.text[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="postTitleField">Category</label>
                <select v-model="fields.category_id" id='postCategoryField' class="form-control">
                    <option :value="category.id" v-for="category in categories">{{category.name}}
                    </option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.category_id">
                    {{ errors.category_id[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="postFile">Добавить файл</label>
                <input  id='postFile' type="file" class="form-control-file" @change="select_file">
            </div>
            <input type="submit" class="btn btn-success" :disabled="form_submit" :value="form_submit ? 'Подождите' : 'Отправить'">
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: {},
                fields: {
                    title: '',
                    text: '',
                    category_id: '',
                    thumbnail: null
                },
                errors: {},
                form_submit: false
            }
        },
        mounted() {
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data
            });

            axios.get('/api/posts/' + this.$route.params.id ).then(response => {
                this.fields = response.data.data
                console.log(response.data.data)
            });
        },
        methods: {
            select_file(event){
                this.fields.thumbnail = event.target.files[0];
            },
            submit_form() {
                this.form_submit = true;

                axios.put('/api/posts/' + this.$route.params.id, this.fields).then(response => {
                    this.$swal('Post updated successfully');
                    this.$router.push('/');
                    this.form_submit = false;
                }).catch(error => {
                    if(error.response.status === 422) {
                        this.$swal({
                            icon: 'error',
                            title: 'Error happened'
                        });
                        this.errors = error.response.data.errors;
                    }
                    this.form_submit = false;
                });

            }
        }
 }
</script>

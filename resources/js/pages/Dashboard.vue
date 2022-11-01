<template>
        <h1 class="text-center font-bold">Cars-table</h1>
        <div class="flex justify-center">
            <div class=" w-96">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Excel file input</label>
                <input class="form-control block w-full px-3 py-1.5 ext-base font-normal text-gray-700 bg-white bg-clip-padding
            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       type="file"
                       id="formFile"
                       ref="file"
                       @change="onFileChange">
                <div class="form-group">

                    <div>
                        <span v-if="fileError" class="text-red-400 error-span" >{{ errorMessage }}</span>
                    </div>
                    <button
                        class="px-3 py-2 mt-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black
                        hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                        type="submit"
                        ref="submit"
                        @click="carsAdd" >SUBMIT
                        <div>
                            <span v-if="fileErrors" class="text-red-400 error-span" >{{ errorMessages }}</span>
                        </div>
                    </button>


                </div>
            </div>
        </div>
    <div v-if="Object.values(cars).length">
    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200">
        <tr class="text-left border-b border-gray-300">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Model</th>
            <th class="px-4 py-3">Color</th>
            <th class="px-4 py-3">Year</th>
            <th class="px-4 py-3">Price</th>
        </tr>

        <tr v-for="car in cars.data" class="bg-gray-700 border-b border-gray-600">
            <td class="px-4 py-3">{{ car.name }}</td>
            <td class="px-4 py-3">{{ car.model }}</td>
            <td class="px-4 py-3">{{ car.color }}</td>
            <td class="px-4 py-3">{{ car.year }}</td>
            <td class="px-4 py-3">{{ car.price }}</td>
        </tr>

    </table>
    <div v-if="cars.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in cars.links" :key="key">
                <div
                    v-if="link.url === null"
                    class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                    v-html="link.label"
                />
                <button
                    v-else
                    class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                    :class="{ 'bg-gray-600 text-white': link.active }"
                    @click="carsGet(link.url)"
                    v-html="link.label"
                ></button>
            </template>
        </div>
    </div>
    </div>
        <div v-else>
            Loading...
        </div>
</template>

<script>


export default {
    name: "Dashboard",
    // props: [
    //   'cars'
    // ],

    data() {
        return {
            excelFile: {},
            fileError: false,
            errorMessage: '',
            fileErrors: false,
            errorMessages: '',
            cars: {},
        }
    },

    methods: {
        getCars(item) {
            if (this.cars.current_page === 1 ) {
                this.cars.data.unshift(item);
            }
            if(this.cars.data.length > 5) {
                this.cars.data.pop();
            }
            this.cars.total++;
            const perPage = Math.ceil(this.cars.total / 5);

            if (perPage > (this.cars.links.length - 2)) {
                const carsLink = {
                    url: window.location.origin + '/get-cars?page=' + perPage,
                    label: perPage,
                    active: false
                };
                this.cars.links.splice(this.cars.links.length - 1, 0, carsLink);
            }
        },

        carsGet(link = null) {
            axios.get(link ?? '/get-cars').then(res => {
                this.cars = res.data.cars;
            });
        },

        // onFileChanges() {
        //     let submitFile = this.$refs.submit[0];
        //     if (submitFile !== null) {
        //         this.errorMessages = "No file selected";
        //         this.fileErrors = true;
        //         return false;
        //     }
        // },

        onFileChange() {
            let exelFile = this.$refs.file.files[0];
            this.excelFile = event.target.files[0];

            let extension = exelFile.name.split('.').pop();
            if (extension !== 'xlsx') {
                this.errorMessage = 'Please you can upload file having extensions .xlsx only.';
                this.fileError = true;
                return false;
            }
        },
        carsAdd() {
            const config = {
                header: {"content_type": "multipart/form-data"}
            }
            let formData = new FormData();
            formData.append('file', this.excelFile);
            axios.post('/cars-add', formData)
                .then(response => {
                    console.log(response.data.message);
                    this.carsGet();
            })
                .catch(function (error) {
                    console.log(1111);
                });
        },
    },
    created() {
        this.carsGet();
    }
}
</script>


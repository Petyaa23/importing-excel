<template>
    <h1 class="text-center font-bold">Cars-table</h1>
<!--    <div class="flex justify-center">-->
<!--        <div class=" w-96">-->
<!--            <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Exel file input</label>-->
<!--            <input class="form-control block w-full px-3 py-1.5 ext-base font-normal text-gray-700 bg-white bg-clip-padding-->
<!--            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile">-->
<!--        </div>-->
<!--        -->
<!--    </div>-->

    <div class="form-group">
<!--        <label for="name">Image</label>-->
        <input type="file" class="form-control-file" @change="onFileChange">
    </div>
    <div class="form-group">
        <button class=" btn btn-primary pull-right" @click="submit">SUBMIT</button>
    </div>

    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200">
        <tr class="text-left border-b border-gray-300">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Model</th>
            <th class="px-4 py-3">Color</th>
            <th class="px-4 py-3">Year</th>
            <th class="px-4 py-3">Price</th>
        </tr>

        <tr v-for="car in cars" class="bg-gray-700 border-b border-gray-600">
            <td class="px-4 py-3">{{ car.name }}</td>
            <td class="px-4 py-3">{{ car.model }}</td>
            <td class="px-4 py-3">{{ car.color }}</td>
            <td class="px-4 py-3">{{ car.year }}</td>
            <td class="px-4 py-3">{{ car.price }}</td>
        </tr>

    </table>
</template>

<script>
export default {
    name: "Dashboard",

    props: [
      'cars'
    ],

    data() {
        return {
            exelFile:{}
        }
    },

    methods: {
        onFileChange() {
            this.exelFile = event.target.files[0];
        },
        submit() {

            const config = {
                header: {"content_type": "multipart/form-data"}
            }
            let formData = new FormData();

            formData.append('file', this.exelFile);
            axios.post('/get-cars', formData)
                .then(function (response) {
                    // this.imageList.push(response.data.data)
                })
                .catch(function (error) {
                    console.log(555);
                });


        }
        // getCars(link = null) {
        //     axios.get(link ?? '/get-cars').then(res => {
        //         this.cars = res.data.cars;
        //     });
        // },
        //
        // created() {
        //     this.getCars();
        // }

    }


}
</script>


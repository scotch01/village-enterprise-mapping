<script setup>
import { reactive, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({
  wilayah: Object
})

const form = reactive({
  // BLOK I (jawaban)
  '105': '',
  '106': '',
  '109': '',
  '110a': '',
  '110b': '',
  '110c': '',

  // usaha
  nama_usaha: '',
  alamat: '',
  telepon: '',
  email: '',
  website: '',
  latitude: '',
  longitude: '',
})

const show110b = computed(() => {
  return ['2','3'].includes(form['110a'])
})

function submit() {
    router.post('/usaha', {
    nama_usaha: form.nama_usaha,
    alamat: form.alamat,
    telepon: form.telepon,
    email: form.email,
    website: form.website,
    latitude: form.latitude,
    longitude: form.longitude,

        jawaban: {
            I: {
            '105': form['105'],
            '106': form['106'],
            '109': form['109'],
            '110a': form['110a'],
            '110b': form['110b'],
            '110c': form['110c'],
            }
        }
    })
}
</script>

<template>
  <div class="space-y-4">

    <!-- AUTO WILAYAH -->
    <input :value="wilayah.provinsi" disabled />
    <input :value="wilayah.kabupaten" disabled />
    <input :value="wilayah.kecamatan" disabled />
    <input :value="wilayah.desa" disabled />

    <!-- 105 -->
    <input v-model="form['105']" placeholder="Dusun" />

    <!-- 106 -->
    <input v-model="form['106']" placeholder="No Bangunan" />

    <!-- 107 -->
    <input v-model="form.nama_usaha" placeholder="Nama Usaha" />

    <!-- 108 -->
    <textarea v-model="form.alamat" placeholder="Alamat"></textarea>
    <input v-model="form.telepon" placeholder="Telepon" />
    <input v-model="form.email" placeholder="Email" />
    <input v-model="form.website" placeholder="Website" />

    <input v-model="form.latitude" placeholder="Latitude" />
    <input v-model="form.longitude" placeholder="Longitude" />

    <!-- 109 -->
    <input v-model="form['109']" placeholder="No Usaha" />

    <!-- 110a -->
    <select v-model="form['110a']">
      <option value="">Pilih</option>
      <option value="1">Khusus Usaha</option>
      <option value="2">Campuran</option>
      <option value="3">Tempat Tinggal</option>
    </select>

    <!-- 110b -->
    <div v-if="show110b">
      <select v-model="form['110b']">
        <option value="1">Dalam rumah</option>
        <option value="2">Diluar tetap</option>
        <option value="3">Keliling</option>
      </select>
    </div>

    <!-- 110c -->
    <select v-model="form['110c']">
      <option value="1">Milik sendiri</option>
      <option value="2">Sewa</option>
      <option value="3">Bebas sewa</option>
      <option value="4">Lainnya</option>
    </select>

    <button @click="submit">Simpan</button>
  </div>
</template>
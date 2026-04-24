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

  // BLOK II
  '201a': '',
  '201b': '',
  '201c': '',
  '201d': '',
  '201e': '',
  '201f': '',
  '202': '',
  '203a': '',
  '203b': '',

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

const show203b = computed(() => {
  return form['203a'] === '1'
})

// reset otomatis
import { watch } from 'vue'

watch(() => form['203a'], (val) => {
  if (val !== '1') {
    form['203b'] = ''
  }
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
      },
      II: {
        '201a': form['201a'],
        '201b': form['201b'],
        '201c': form['201c'],
        '201d': form['201d'],
        '201e': form['201e'],
        '201f': form['201f'],
        '202': form['202'],
        '203a': form['203a'],
        '203b': form['203b'],
      }
    }
  })
}
</script>

<template>
  <div class="space-y-4">

    <h3>Blok I - Pengenalan Tempat Usaha</h3>

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

    <hr />

  <h3>Blok II - Karakteristik Pengusaha</h3>

  <!-- 201a -->
  <input v-model="form['201a']" placeholder="Nama Pengusaha" />

  <!-- 201b -->
  <input v-model="form['201b']" placeholder="NIK (16 digit)" />

  <!-- 201c -->
  <select v-model="form['201c']">
    <option value="">Jenis Kelamin</option>
    <option value="1">Laki-laki</option>
    <option value="2">Perempuan</option>
  </select>

  <!-- 201d -->
  <input type="number" v-model="form['201d']" placeholder="Umur" />

  <!-- 201e -->
  <input v-model="form['201e']" placeholder="No HP" />

  <!-- 201f -->
  <select v-model="form['201f']">
    <option value="">Pendidikan</option>
    <option value="1">Tidak tamat SD</option>
    <option value="2">SD</option>
    <option value="3">SMP</option>
    <option value="4">SMA</option>
    <option value="5">SMK</option>
    <option value="6">Diploma I/II/III</option>
    <option value="7">Diploma IV/S1</option>
    <option value="8">S2</option>
    <option value="9">S3</option>
  </select>

  <!-- 202 -->
  <select v-model="form['202']">
    <option value="">Disabilitas</option>
    <option value="1">Ya</option>
    <option value="2">Tidak</option>
  </select>

  <!-- 203a -->
  <select v-model="form['203a']">
    <option value="">Punya pekerjaan lain?</option>
    <option value="1">Ya</option>
    <option value="2">Tidak</option>
  </select>

  <!-- 203b -->
  <div v-if="show203b">
    <select v-model="form['203b']">
      <option value="">Jenis pekerjaan lain</option>
      <option value="1">ASN/PNS</option>
      <option value="2">TNI/Polri</option>
      <option value="3">BUMN/BUMD</option>
      <option value="4">Karyawan Swasta</option>
      <option value="5">Lainnya</option>
    </select>
  </div>

    <button @click="submit">Simpan</button>
  </div>
</template>
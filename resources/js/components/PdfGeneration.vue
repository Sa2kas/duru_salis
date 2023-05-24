<template>
  <div>
    <div class="flex flex-row items-center justify-between mb-8">
      <div>
        <img src="https://i.postimg.cc/sD88kCxN/logo2-1.png" height="160" width="145">
      </div>

      <div class="w-2/5">
        <h1 class="font-bold mb-2 text-4xl">{{ credit ? 'Credit' : invoice }}</h1>
        <dl class="flex flex-wrap justify-between">
          <dt class="pr-2 w-3/12">{{ numberLabel }}:</dt>
          <dd class="w-9/12">{{ invoiceNumber }}</dd>

          <dt class="pr-2 w-3/12">{{ dateTextLabel }}:</dt>
          <dd class="w-9/12">{{ invoiceDate }}</dd>
        </dl>
      </div>
    </div>

    <div class="items-center flex justify-between mb-8">
      <div class="border-2 border-blue-600 px-4 py-2 w-1/2">
        {{ clientName | upcase }}<br>
        {{ clientEmail | newline_to_br }}<br>
        {{ clientPhone | newline_to_br }}
      </div>
    </div>

    <table class="border-collapse mb-8 numeric-tabular table table-auto w-full">
      <thead>
        <tr class="bg-blue-600 text-white">
          <th class="font-normal text-left" colspan="2">{{ textTitle }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in tableData" :class="cycleClasses[index]" :key="index" >
          <td class="text-left"><strong>{{ item.label }}</strong></td>
          <td class="text-left">{{ item.value }}</td>
        </tr>
      </tbody>
    </table>

    <div class="flex mb-8">
      <dl class="bg-blue-100 flex flex-wrap leading-snug ml-auto numeric-tabular py-2 w-2/5">
        <dt class="block m-0 p-0 pl-4 w-3/5">{{ text8 }}</dt>
        <dd class="block m-0 p-0 pr-4 text-right w-2/5">€{{ total }}</dd>
      </dl>
    </div>

    <hr>

    <p class="mt-4 text-center">
      <small>
        {{ companyInfo }}
      </small>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      credit: false,
      invoice: '',
      numberLabel: '',
      invoiceNumber: '',
      dateTextLabel: '',
      invoiceDate: '',
      clientName: '',
      clientEmail: '',
      clientPhone: '',
      textTitle: '',
      tableData: [
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
        { label: '', value: '' },
      ],
      cycleClasses: ['bg-white', 'bg-blue-100'],
      text8: '',
      total: '',
      companyInfo: `UAB "Durų šalis"
      Žiemgalių g. 8, Kaunas
      Įm. kodas 303224483
      A/s LT94 7300 0101 5166 3393
      AB bankas Swedbank`,
    };
  },
  filters: {
    upcase(value) {
      return value.toUpperCase();
    },
    newline_to_br(value) {
      return value.replace(/\n/g, '<br>');
    },
  },
};
</script>

<style>

.table td,
.table th {
  border: 1px solid white;
  padding: 0.25rem 1rem;
}

.numeric-tabular {
  /* Sets the numbers width so that they stay aligned vertically. */
  font-variant-numeric: tabular-nums;
}
</style>

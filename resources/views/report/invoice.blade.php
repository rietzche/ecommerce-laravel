<!DOCTYPE html>
<html>
  <head>
    <title>Invoice Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style type="text/css">
      .clear {
        float: none;
        clear: both;
      }
    </style>
  </head>
  <body>
    {{! $idUser = App\Order::where('code', $code)->value('id_user') }}
    {{! $idAddress = App\Order::where('code', $code)->value('id_address') }}
    <div>
      <div style="border:1px solid black; padding: 10px; background-color: #f2f2f2">
        <h4 class="text-center text-muted">SHABBY ORGANIZER</h4>
        <div style="background-color: #ffffff; padding: 5px; font-size: 14px">
            <table style="float: left;">
              <tr>
                <td>Kota Asal</td><td>:</td>
                <td> Tanggerang</td>
              </tr>
              <tr>
                <td>No. Pesanan</td><td>:</td>
                <td> {{ $code }}</td>
              </tr>
            </table>
            <table style="float: right;">
              <tr>
                <td>Kota Tujuan</td><td>:</td>
                <td> {{ App\Address::where('id_user', $idUser)->value('city') }} </td>
              </tr>
              <tr>
                <td>Jasa Kirim</td><td>:</td>
                <td> {{ App\Order::where('code', $code)->value('courier') }}</td>
              </tr>
            </table>
            <div class="clear"></div>
        </div>
      </div>

      <div style="border:1px solid black; font-size: 14px">
        <div style="border:1px solid black; padding: 10px;">
          <div style="border:1px solid black; background-color: #595959; color: #ffffff; padding: 4px 20px">
            PENGIRIM
          </div>
          <table border="1" width="100%">
            <tr>
              <td>Nama</td>
              <td> Shabby Organizer</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>Banten</td>
            </tr>
            <tr>
              <td>Kota</td>
              <td>Tanggerang</td>
            </tr>
          </table>
        </div>
        
        <div style="border:1px solid black; padding: 10px;">
          <div style="border:1px solid black; background-color: #595959; color: #ffffff; padding: 4px 20px">
            PENERIMA
          </div>
          <table border="1" width="100%">
            <tr>
              <td>Nama</td>
              <td>{{App\Address::find($idAddress)->receiver_name}}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>{{App\Address::find($idAddress)->others}}, {{App\Address::find($idAddress)->region}}, {{App\Address::find($idAddress)->valuecity}}, {{App\Address::find($idAddress)->province}}, {{App\Address::find($idAddress)->value('zip_code')}}</td>
            </tr>
            <tr>
              <td>Kota</td>
              <td>{{App\Address::where('id_user', $idUser)->value('city')}}</td>
            </tr>
          </table>
        </div>
        
        <div style="border:1px solid black; padding: 10px; ">
          <div style="border:1px solid black; background-color: #595959; color: #ffffff; padding: 4px 20px">
            DAFTAR BARANG
          </div>
          <table border="1" width="100%">
            <tr bgcolor="#f2f2f2">
              <td>Nama Produk</td>
              <td>Kuantitas</td>
            </tr>
            <tr>
              {{! $idProduct = App\Order::where('code', $code)->value('id_product') }}
              <td>{{App\Product::find($idProduct)->value('name')}}</td>
              <td> {{ App\Order::where('code', $code)->value('quantity') }} </td>
            </tr>
          </table>
        </div>
        <div style="border:1px solid black; padding: 10px">
          <span><b>Estimasi Ongkos Kirim : </b>Rp. 25.000</span><br>
          <span><b>Total Berat : </b>650</span>
        </div>

      </div>

    </div>
  </body>
</html>
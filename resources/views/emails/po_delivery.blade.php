<h3 style="border-bottom: 1px solid grey;">Your Delivery Order {{ $code }} </h3> 
<table>
    <tbody>
        <tr>
            <td bgcolor="#ffffff" id="m_-3784408755349078820contentContainer" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table align="left" width="100%" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
                    <tbody>
                        <tr>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td align="left" width="550" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                <table align="left" width="100%" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
                                    <tbody>
                                        <tr>
                                            <td style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                                <div style="margin:10px 2px">
                                                    <p style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">
                                                        Notification Delivery From {{ $header->supplier_name }},
                                                    </p>
                                                </div>
                                                <div style="margin:10px 2px">
                                                    <p style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">
                                                        Berdasarkan system, Supplier {{ $header->supplier_name }} telah Mengirimkan list item berikut :
                                                    </p>
                                                    <br>
                                                    <table border="0" cellpadding="5" cellspacing="0" id="m_-3784408755349078820templateList" width="100%" style="border-collapse:collapse;border-spacing:0;font-size:12px;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0 0 25px;padding:0" bgcolor="#FFFFFF">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="4" style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px" bgcolor="#900135">
                                                                    <h2 style="font-family:Arial,sans-serif;color:#ffffff;line-height:1.5;font-size:14px;margin:0;padding:5px 0">
                                                                        No. PO : {{ ' '.$code }}
                                                                    </h2>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">Tanggal Pengiriman</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">{{ $header->purchase_date }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="4" style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px" bgcolor="#900135"></th>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" class="m_-3784408755349078820headingList" valign="top" width="65%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px" bgcolor="#F0F0F0">
                                                                    <strong style="color:#555;font-size:14px">Nama Barang</strong>
                                                                </td>
                                                                <td align="center" class="m_-3784408755349078820headingList" valign="top" width="10%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px" bgcolor="#F0F0F0">
                                                                    <strong style="color:#555;font-size:14px"></strong>
                                                                </td>
                                                                <td align="center" class="m_-3784408755349078820headingList" valign="top" width="10%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px" bgcolor="#F0F0F0">
                                                                    <strong style="color:#555;font-size:14px"></strong>
                                                                </td>
                                                                <td align="right" class="m_-3784408755349078820headingList" valign="top" width="15%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px" bgcolor="#F0F0F0">
                                                                    <strong style="color:#555;font-size:14px">Qty</strong>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            $sub = 0;
                                                            $total = 0;
                                                            ?>
                                                            @foreach($detail as $c)
                                                            <?php
                                                            $sub = $c->qty_prepare * $c->price;
                                                            $total = $total + $sub;
                                                            ?>

                                                            <tr>
                                                                <td align="left" valign="middle" width="50%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                {{ $c->product_name }}
                                                                </td>
                                                                <td align="center" valign="middle" width="10%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    
                                                                </td>
                                                                <td align="center" valign="middle" width="15%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                      
                                                                </td>
                                                                <td align="right" valign="middle" width="25%" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0"></span><span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">
                                                                        {{ $c->qty_prepare }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th colspan="4" style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px" bgcolor="#900135"></th>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>

                                                    <br>
                                                    <p style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">
                                                        Segera Lakukan Prepare barang karena pesanan sudah Lunas
                                                        <a href="" style="font-family:Arial,sans-serif;color:#a30046!important;line-height:1.5;text-decoration:none;font-size:14px;margin:0;padding:0" target="_blank" >
                                                            Hubungi {{ config('app.name') }} (Telp {{ config('website.phone') }}).
                                                        </a>
                                                    </p>
                                                    <br>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                        <tr>
                            <td height="30" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="30" width="550" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="30" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table align="left" id="m_-3784408755349078820securityAnnouncementWrapper" width="100%" style="border-collapse:collapse;border-spacing:0;font-size:12px;margin:0;padding:0" bgcolor="#f0f0f0">
                    <tbody>
                        <tr>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="24" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="10" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="516" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                        <tr>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="26" width="24" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                <img alt="Hati-hati" src="https://ci4.googleusercontent.com/proxy/17QqMspfedBHa9ObiGH2rhbjYiGN_eclyCwL-Ws0XG_XSoZfj3vqh6hF2USepehm1Xc7TX788N1xbTEq_KlBHisQN_BSgbs=s0-d-e1-ft#https://www.pln.co.id/images/icon_warning.png" style="height:auto;line-height:100%;outline:none;text-decoration:none;border:0 none" class="CToWUd">
                            </td>
                            <td width="10" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td align="left" width="516" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                <p style="font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                    Segala bentuk informasi seperti
                                    <b>
                                        nomor kontak, alamat e-mail, atau password kamu bersifat rahasia.
                                    </b>
                                    Jangan menginformasikan data-data tersebut kepada siapa pun, termasuk kepada pihak yang mengatasnamakan {{ config('app.name') }}.
                                </p>
                            </td>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                        <tr>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="24" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="10" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="516" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>

        <tr>
            <td style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table id="m_-3784408755349078820footerSeparator" width="100%" style="border-collapse:collapse;border-spacing:0;table-layout:fixed;border-top-width:2px;border-top-style:solid;border-top-color:#ccc;margin:0;padding:0">
                    <tbody>
                        <tr>
                            <td height="2" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

    </tbody>
</table>


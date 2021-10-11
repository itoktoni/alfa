<h3 style="border-bottom: 1px solid grey;">Notification Payment From {{ $sales }} </h3> 
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
                                                        Hai {{ config('app.name') }},
                                                    </p>

                                                </div>
                                                <div style="margin:10px 2px">
                                                    <p style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">
                                                        Ada Pembayaran dari Sales tanggal {{ $data['payment_date'] }}.
                                                    </p>
                                                    <br>
                                                    <table border="0" cellpadding="5" cellspacing="0" id="m_-3784408755349078820templateList" width="100%" style="border-collapse:collapse;border-spacing:0;font-size:12px;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0 0 25px;padding:0" bgcolor="#FFFFFF">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="4" style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px" bgcolor="#900135">
                                                                    <h2 style="font-family:Arial,sans-serif;color:#ffffff;line-height:1.5;font-size:14px;margin:0;padding:5px 0">
                                                                        Payment Voucher : {{ $voucher }}
                                                                    </h2>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">Pengirim</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">{{ $data['payment_person'] }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">Account</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                   <span style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0"> Dari Bank {{ $data['account_from'] }} ke bank {{ $data['account_to'] }}</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">Jumlah</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                   <span style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0"> {{ number_format($data['payment_amount']) }}</span>
                                                                </td>
                                                            </tr>
                                                        
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">Pesan</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2"  style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
                                                                    <span style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:14px;margin:0;padding:0">{{ $data['payment_description'] }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="4" style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px" bgcolor="#900135"></th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
            <td bgcolor="#ffffff" id="m_-3784408755349078820contentContainer" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table align="left" width="100%" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
                    <tbody>
                        <tr>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td align="left" width="550" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
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
                    <tbody><tr>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="24" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="10" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="516" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="5" width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                        </tr>
                        <tr>
                            <td width="15" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0"></td>
                            <td height="26" width="24" style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                
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
                    </tbody></table>
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


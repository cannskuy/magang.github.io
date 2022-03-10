<?php

class Data_model extends CI_model
{
    public function hapusDataPinjaman($id)
    {
        $this->db->where('form_id', $id);
        $this->db->delete('form');
    }

    public function hapusDataLaporan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bensin');
    }

    private $_table = "form";
    function tampil_laporan()
    {
        return $this->db->get($this->_table)->result();
    }
    function cetak_laporan($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function getFormById($id)
    {
        return $this->db->get_where('form', ['form_id' => $id])->row_array();
    }

    public function getFormPById($id)
    {
        return $this->db->get_where('form_pinjam', ['form_id' => $id])->row_array();
    }

    public function getAllNopol()
    {
        return $this->db->get('driver')->result_array();
    }

    public function konfirmasi()
    {
        $data = [
            "form_id" => $this->input->post('form_id', true),
            "name" => $this->input->post('nama', true),
            'NPP' => $this->input->post('NPP', true),
            'unit_kerja' => $this->input->post('unit_kerja', true),
            'tujuan' => $this->input->post('tujuan', true),
            'start' => htmlspecialchars($this->input->post('start', true)),
            'no_polisi' => $this->input->post('no_polisi', true),
            'driver' => $this->input->post('driver', true),
            'ket' => 'Belum Kembali'
        ];

        $this->db->insert('form_pinjam', $data);

        $this->db->where('form_id', $this->input->post('form_id'));
        $this->db->delete('form');
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update()
    {
        $data = [
            "form_id" => $this->input->post('form_id', true),
            'end' => htmlspecialchars($this->input->post('end', true)),
            'ket' => $this->input->post('ket', true),
        ];

        $this->db->where('form_id', $this->input->post('form_id'));
        $this->db->update('form_pinjam', $data);
    }

    public function hapusFormPinjam($id)
    {
        $this->db->where('form_id', $id);
        $this->db->delete('form_pinjam');
    }

    public function kirimWA()
    {

        $message = "Peminjaman kendaraan dengan plat BG telah dibuat. Anda akan menjadi driver pada perjalanan ini.";

        echo "<div class='row ml-5 mb-4'>";
        echo "<div class='col-md-5 col-sm-12 col-xs-12'>";
        echo  "<center><input class='form-control mt4' type='text' value='https://api.whatsapp.com/send?phone=6281280017205&text=$message'aria-label='readonly input example' readonly><center>";
        echo '</div>';
        echo "<div class='col-md-6 col-sm-12 col-xs-12'>";
        echo "<a href='https://api.whatsapp.com/send?phone=6281280017205&text=$message'><button type='button' class='btn btn-primary'>Chat</button></a>";
        echo '</div>';
        echo '</div>';
    }
}

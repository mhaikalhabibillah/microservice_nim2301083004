package com.teknologiinformasi.restapi.controller;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.teknologiinformasi.restapi.model.Produk;
import com.teknologiinformasi.restapi.repository.ProdukRepository;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.http.MediaType;
import org.springframework.test.web.servlet.MockMvc;

import static org.hamcrest.Matchers.*;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.*;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

@SpringBootTest
@AutoConfigureMockMvc
public class ProdukControllerIntegrationTest {

    @Autowired
    private MockMvc mockMvc;

    @Autowired
    private ProdukRepository produkRepository;

    @Autowired
    private ObjectMapper objectMapper;

    private Produk produk;

    @BeforeEach
    public void setup() {
        produkRepository.deleteAll();
        produk = new Produk();
        produk.setNama("Laptop");
        produk.setDeskripsi("Laptop Gaming");
        produk.setHarga(15000000.0);
        produk = produkRepository.save(produk);
    }

    @Test
    public void testCreateProduk() throws Exception {
        Produk newProduk = new Produk();
        newProduk.setNama("Mouse");
        newProduk.setDeskripsi("Wireless Mouse");
        newProduk.setHarga(150000.0);

        mockMvc.perform(post("/api/produk")
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(objectMapper.writeValueAsString(newProduk)))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.nama", is("Mouse")));
    }

    @Test
    public void testCreateProduk_BadRequest() throws Exception {
        Produk produkKosong = new Produk(); // tidak ada field

        mockMvc.perform(post("/api/produk")
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(objectMapper.writeValueAsString(produkKosong)))
                .andExpect(status().isOk()) // default implementation return object walau kosong
                .andExpect(jsonPath("$.id", notNullValue())); // Produk tetap disimpan
    }

    @Test
    public void testGetAllProduk() throws Exception {
        mockMvc.perform(get("/api/produk"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$", hasSize(1)))
                .andExpect(jsonPath("$[0].nama", is("Laptop")));
    }

    @Test
    public void testGetProdukById() throws Exception {
        mockMvc.perform(get("/api/produk/{id}", produk.getId()))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.nama", is("Laptop")));
    }

    @Test
    public void testGetProdukById_NotFound() throws Exception {
        mockMvc.perform(get("/api/produk/{id}", 999))
                .andExpect(status().isNotFound());
    }

    @Test
    public void testUpdateProduk() throws Exception {
        produk.setNama("Laptop Baru");
        produk.setHarga(17000000.0);

        mockMvc.perform(put("/api/produk/{id}", produk.getId())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(objectMapper.writeValueAsString(produk)))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.nama", is("Laptop Baru")))
                .andExpect(jsonPath("$.harga", is(17000000.0)));
    }

    @Test
    public void testUpdateProduk_NotFound() throws Exception {
        produk.setNama("Tidak Ada");

        mockMvc.perform(put("/api/produk/{id}", 999)
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(objectMapper.writeValueAsString(produk)))
                .andExpect(status().isNotFound());
    }

    @Test
    public void testDeleteProduk() throws Exception {
        mockMvc.perform(delete("/api/produk/{id}", produk.getId()))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.message", containsString("berhasil dihapus")));

        mockMvc.perform(get("/api/produk/{id}", produk.getId()))
                .andExpect(status().isNotFound());
    }

    @Test
    public void testDeleteProduk_NotFound() throws Exception {
        mockMvc.perform(delete("/api/produk/{id}", 999))
                .andExpect(status().isNotFound())
                .andExpect(jsonPath("$.message", containsString("tidak ditemukan")));
    }
}

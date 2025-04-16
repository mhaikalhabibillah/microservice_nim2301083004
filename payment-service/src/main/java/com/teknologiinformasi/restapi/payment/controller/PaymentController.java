package com.teknologiinformasi.restapi.payment.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.teknologiinformasi.restapi.payment.model.Payment;
import com.teknologiinformasi.restapi.payment.service.PaymentService;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

@RestController
@RequestMapping("/api/payments")
public class PaymentController {

    private static final Logger log = LoggerFactory.getLogger(PaymentController.class);

    @Autowired
    private PaymentService paymentsService;

    // Endpoint untuk mengambil semua payment
    @GetMapping
    public List<Payment> getAllPayments() {
        log.info("GET /api/payment accessed");
        return paymentsService.getAllPayments();
    }

    // Endpoint untuk mengambil payment berdasarkan id
    @GetMapping("/{id}")
    public ResponseEntity<Payment> getPaymentById(@PathVariable Long id) {
        log.info("GET /api/payment/{} accessed", id);
        return paymentsService.getPaymentById(id)
                .map(payment -> ResponseEntity.ok().body(payment))
                .orElse(ResponseEntity.notFound().build());
    }

    // Endpoint untuk membuat payment baru
    @PostMapping
    public Payment createPayment(@RequestBody Payment payment) {
        log.info("POST /api/payment accessed with body: {}", payment);
        return paymentsService.createPayment(payment);
    }

    // Endpoint untuk mengupdate payment yang sudah ada
    @PutMapping("/{id}")
    public ResponseEntity<Payment> updatePayment(@PathVariable Long id, @RequestBody Payment paymentDetails) {
        log.info("PUT /api/payment/{} accessed with body: {}", id, paymentDetails);

        try {
            Payment updatedPayment = paymentsService.updatePayment(id, paymentDetails);
            return ResponseEntity.ok(updatedPayment);
        } catch (RuntimeException e) {
            log.warn("PUT /api/payment/{} failed: {}", id, e.getMessage());
            return ResponseEntity.notFound().build();
        }
    }

    // Endpoint untuk menghapus payment
    @DeleteMapping("/{id}")
    public ResponseEntity<Map<String, String>> deletePayment(@PathVariable Long id) {
        log.info("DELETE /api/payment/{} accessed", id);
        Map<String, String> response = new HashMap<>();
        try {
            paymentsService.deletePayment(id);
            response.put("message", "Payment berhasil dihapus");
            return ResponseEntity.ok(response);
        } catch (RuntimeException e) {
            response.put("message", "Payment tidak ditemukan dengan id " + id);
            log.warn("DELETE /api/payment/{} failed: {}", id, e.getMessage());
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(response);
        }
    }
}

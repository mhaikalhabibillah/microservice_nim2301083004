package com.teknologiinformasi.auth.model;
 
import jakarta.persistence.*;
import lombok.*;

@Entity
@Data
@NoArgsConstructor
@AllArgsConstructor
@Table(name = "users")
public class User {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nama;
    @Column(unique = true)
    private String email;
    private String password;
    private String nohp;
}
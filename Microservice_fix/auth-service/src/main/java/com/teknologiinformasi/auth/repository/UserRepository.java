package com.teknologiinformasi.auth.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.teknologiinformasi.auth.model.User;

import java.util.Optional;

public interface UserRepository extends JpaRepository<User, Long> {
    Optional<User> findByEmail(String email);
}
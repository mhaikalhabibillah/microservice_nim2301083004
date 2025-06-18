package com.teknologiinformasi.auth.service;

import com.teknologiinformasi.auth.model.User;
import com.teknologiinformasi.auth.repository.UserRepository;
import com.teknologiinformasi.auth.dto.UserLoginRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class UserService {

    @Autowired
    private UserRepository userRepository;

    public User createUser(User user) {
        return userRepository.save(user);
    }

    public List<User> getAllUsers() {
        return userRepository.findAll();
    }

    public Optional<User> getUserById(Long id) {
        return userRepository.findById(id);
    }

    public Optional<User> login(UserLoginRequest request) {
        Optional<User> user = userRepository.findByEmail(request.getEmail());
        return user.filter(u -> u.getPassword().equals(request.getPassword()));
    }

    public void deleteUser(Long id) {
        userRepository.deleteById(id);
    }

    public User updateUser(Long id, User updatedUser) {
        User existing = userRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("User not found"));
        existing.setNama(updatedUser.getNama());
        existing.setEmail(updatedUser.getEmail());
        existing.setPassword(updatedUser.getPassword());
        existing.setNohp(updatedUser.getNohp());
        return userRepository.save(existing);
    }
}
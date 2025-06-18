package com.teknologiinformasi.restapi.contract;
import au.com.dius.pact.consumer.MockServer;
import au.com.dius.pact.consumer.dsl.PactDslJsonBody;
import au.com.dius.pact.consumer.dsl.PactDslWithProvider;
import au.com.dius.pact.consumer.junit5.PactConsumerTestExt;
import au.com.dius.pact.consumer.junit5.PactTestFor;
import au.com.dius.pact.core.model.PactSpecVersion;
import au.com.dius.pact.core.model.RequestResponsePact;
import au.com.dius.pact.core.model.annotations.Pact;
import io.restassured.RestAssured;
import io.restassured.response.Response;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;

 
@ExtendWith(PactConsumerTestExt.class)
@PactTestFor(providerName = "ProdukProvider", pactVersion = PactSpecVersion.V3)
public class ProdukServiceContractTest {

    @Pact(provider = "ProdukProvider", consumer = "ProdukConsumer")
public RequestResponsePact createPact(PactDslWithProvider builder) {
    PactDslJsonBody responseBody = new PactDslJsonBody()
        .numberType("id", 1)
        .stringType("nama", "Laptop")
        .stringType("deskripsi", "Laptop Gaming");

    return builder
        .given("Produk exist")
        .uponReceiving("A request to get produk")
            .path("/api/produk/1")
            .method("GET")
        .willRespondWith()
            .status(200)
            .body(responseBody)
        .toPact();
}

    @Test
    void testProdukGet(MockServer mockServer) {
        Response response = RestAssured.given()
            .baseUri(mockServer.getUrl())
            .get("/api/produk/1");

        Assertions.assertEquals(200, response.getStatusCode());
    }
}

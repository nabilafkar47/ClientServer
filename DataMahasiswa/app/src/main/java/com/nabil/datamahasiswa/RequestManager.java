package com.nabil.datamahasiswa;

import android.content.Context;
import android.util.Base64;
import android.widget.Toast;

import com.nabil.datamahasiswa.Models.ApiResponse;

import java.io.IOException;

import okhttp3.Interceptor;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.GET;
import retrofit2.http.Query;

public class RequestManager {
    Context context;

    OkHttpClient okHttpClient = new OkHttpClient.Builder()
            .addInterceptor(new Interceptor() {
                @Override
                public okhttp3.Response intercept(Chain chain) throws IOException {
                    Request originalRequest = chain.request();

                    String username = "admin";
                    String password = "1234";

                    String credentials = username + ":" + password;
                    String base64Credentials = Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                    String authHeader = "Basic " + base64Credentials;

                    Request newRequest = originalRequest.newBuilder()
                            .header("Authorization", authHeader)
                            .build();

                    return chain.proceed(newRequest);
                }
            })
            .build();

    Retrofit retrofit = new Retrofit.Builder()
            .baseUrl("http://10.0.2.2/client-server/rest-server/api/")
            .addConverterFactory(GsonConverterFactory.create())
            .client(okHttpClient)
            .build();

    public void getData(OnFetchDataListener listener){
        CallApi callApi = retrofit.create(CallApi.class);
        Call<ApiResponse> call = callApi.callHeadlines(context.getString(R.string.api_key));

        try {
            call.enqueue(new Callback<ApiResponse>() {
                @Override
                public void onResponse(Call<ApiResponse> call, Response<ApiResponse> response) {
                    if (!response.isSuccessful()){
                        Toast.makeText(context, "Error!", Toast.LENGTH_SHORT).show();
                    }

                    listener.onFetchData(response.body().getData(), response.message());
                }

                @Override
                public void onFailure(Call<ApiResponse> call, Throwable t) {
                    listener.onError("Request Failed!");
                }
            });
        }
        catch (Exception e) {
            e.printStackTrace();
        }
    }

    public RequestManager(Context context) {
        this.context = context;
    }

    public interface CallApi {
        @GET("Mahasiswa")
        Call<ApiResponse> callHeadlines(
                @Query("api-key") String api_key
        );
    }
}

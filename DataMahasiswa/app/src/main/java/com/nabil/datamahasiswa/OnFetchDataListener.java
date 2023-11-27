package com.nabil.datamahasiswa;

import com.nabil.datamahasiswa.Models.Data;

import java.util.List;

public interface OnFetchDataListener<ApiResponse> {
    void onFetchData(List<Data> list, String message);
    void onError(String message);
}
